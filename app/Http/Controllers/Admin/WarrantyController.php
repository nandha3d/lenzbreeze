<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWarrantyRequest;
use App\Http\Requests\UpdateWarrantyRequest;
use App\Models\Retailer;
use App\Models\Warranty;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class WarrantyController extends Controller
{
    /**
     * List warranties with stats, search, and filters.
     */
    public function index(Request $request)
    {
        $query = Warranty::with('store')->latest();

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by status
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by store (Retail Store)
        if ($request->filled('store_id')) {
            $query->where('store_id', $request->store_id);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('purchase_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('purchase_date', '<=', $request->date_to);
        }

        $warranties = $query->paginate(20)->withQueryString();

        // Statistics
        $stats = [
            'total_active'  => Warranty::where('status', Warranty::STATUS_ACTIVE)->where('expiry_date', '>', now())->count(),
            'expiring_soon' => Warranty::expiringSoon()->count(),
            'total_claims'  => Warranty::withClaims()->count(),
            'resolved'      => Warranty::where('status', Warranty::STATUS_RESOLVED)->count(),
        ];

        // Fetch stores from SalePro Customers
        $stores = \App\Models\Customer::orderBy('name')->get();

        return view('admin.warranties.index', compact('warranties', 'stats', 'stores'));
    }

    /**
     * Show warranty registration form.
     */
    public function create()
    {
        $stores = \App\Models\Customer::orderBy('name')->get();
        return view('admin.warranties.form', compact('stores'));
    }

    /**
     * Store a new warranty.
     */
    public function store(StoreWarrantyRequest $request)
    {
        $validated = $request->validated();

        // Handle photo upload
        if ($request->hasFile('customer_photo')) {
            $validated['customer_photo'] = $request->file('customer_photo')->store('warranty-photos', 'public');
        }

        // Auto-calculate expiry date
        $purchaseDate = Carbon::parse($validated['purchase_date']);
        $validated['expiry_date'] = $purchaseDate->copy()->addMonths((int) $validated['warranty_months']);

        // Denormalize Store name from SalePro Customers
        $store = \App\Models\Customer::find($validated['store_id']);
        $validated['retailer_name'] = $store?->name;

        // Set status
        $validated['status'] = Warranty::STATUS_ACTIVE;

        Warranty::create($validated);

        return redirect()->route('admin.warranties')->with('success', 'Warranty registered successfully.');
    }

    /**
     * Show warranty detail.
     */
    public function show(Warranty $warranty)
    {
        $warranty->load('store');
        return view('admin.warranties.show', compact('warranty'));
    }

    /**
     * Show warranty edit form.
     */
    public function edit(Warranty $warranty)
    {
        $stores = \App\Models\Customer::orderBy('name')->get();
        return view('admin.warranties.form', compact('warranty', 'stores'));
    }

    /**
     * Update warranty (including claim workflow).
     */
    public function update(UpdateWarrantyRequest $request, Warranty $warranty)
    {
        $validated = $request->validated();

        // Handle photo upload
        if ($request->hasFile('customer_photo')) {
            $validated['customer_photo'] = $request->file('customer_photo')->store('warranty-photos', 'public');
        }

        // Auto-calculate expiry date
        $purchaseDate = Carbon::parse($validated['purchase_date']);
        $validated['expiry_date'] = $purchaseDate->copy()->addMonths((int) $validated['warranty_months']);

        // Denormalize Store name from SalePro Customers
        $store = \App\Models\Customer::find($validated['store_id']);
        $validated['retailer_name'] = $store?->name;

        // Auto-set claim_date when status moves to under_claim for the first time
        if ($validated['status'] === Warranty::STATUS_UNDER_CLAIM && !$warranty->claim_date) {
            $validated['claim_date'] = now()->toDateString();
        }

        $warranty->update($validated);

        return redirect()->route('admin.warranties.show', $warranty)->with('success', 'Warranty updated successfully.');
    }

    /**
     * Delete warranty.
     */
    public function destroy(Warranty $warranty)
    {
        $warranty->delete();
        return redirect()->route('admin.warranties')->with('success', 'Warranty deleted successfully.');
    }

    /**
     * AJAX serial number lookup.
     */
    public function serialLookup(Request $request)
    {
        $serial = $request->input('serial');
        $warranty = Warranty::where('serial_number', $serial)->first();

        if ($warranty) {
            return response()->json([
                'found'        => true,
                'product_name' => $warranty->product_name,
                'status'       => $warranty->status,
                'customer_name'=> $warranty->customer_name,
            ]);
        }

        return response()->json(['found' => false]);
    }

    /**
     * AJAX order lookup (from SalePro).
     */
    public function orderLookup(Request $request)
    {
        $reference = $request->input('order_number');
        if (str_starts_with(strtolower($reference), 'lb-')) {
            $reference = substr($reference, 3);
        }
        
        $sale = \App\Models\Sale::with('customer', 'products')->where('reference_no', $reference)->first();

        if ($sale) {
            $productNames = [];
            if ($sale->products) {
                foreach ($sale->products as $product) {
                    $productNames[] = $product->name;
                }
            }
            
            return response()->json([
                'found'           => true,
                'store_id'        => $sale->customer_id,
                'store_name'      => $sale->customer->name ?? '',
                'grand_total'     => $sale->grand_total,
                'sale_status'     => $sale->sale_status,
                'product_name'    => implode(', ', $productNames),
                'purchase_date'   => $sale->created_at->format('Y-m-d'),
                'end_user_name'   => $sale->end_user_name ?? '',
                'end_user_phone'  => $sale->end_user_phone ?? '',
                'end_user_email'  => $sale->end_user_email ?? '',
                'end_user_address'=> $sale->end_user_address ?? '',
            ]);
        }

        return response()->json(['found' => false]);
    }
}
