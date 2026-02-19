<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Inquiry;
use App\Models\Subscriber;
use App\Models\Page;
use App\Models\Warranty;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $productCount = Product::count();
        $newInquiries = Inquiry::where('status', 'new')->count();
        $subscriberCount = Subscriber::where('status', 'active')->count();
        $pageCount = Page::count();
        $warrantyCount = Warranty::count();
        
        $recentInquiries = Inquiry::latest()->take(5)->get();
        $recentSubscribers = Subscriber::latest()->take(5)->get();
        $recentWarranties = Warranty::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'productCount', 
            'newInquiries', 
            'subscriberCount', 
            'pageCount', 
            'warrantyCount',
            'recentInquiries', 
            'recentSubscribers',
            'recentWarranties'
        ));
    }

    // Warranties
    public function warranties(Request $request)
    {
        $query = Warranty::latest();
        if ($request->filled('search')) {
            $query->where('serial_number', 'like', '%' . $request->search . '%')
                  ->orWhere('customer_name', 'like', '%' . $request->search . '%');
        }
        $warranties = $query->paginate(20);
        return view('admin.warranties.index', compact('warranties'));
    }

    public function createWarranty()
    {
        return view('admin.warranties.form');
    }

    public function storeWarranty(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'retailer_name' => 'nullable|string|max:255',
            'purchase_date' => 'required|date',
            'expiry_date' => 'required|date|after:purchase_date',
            'status' => 'required|in:active,expired,void',
            'notes' => 'nullable|string',
        ]);

        Warranty::create($validated);
        return redirect()->route('admin.warranties')->with('success', 'Warranty generated successfully.');
    }

    public function editWarranty(Warranty $warranty)
    {
        return view('admin.warranties.form', compact('warranty'));
    }

    public function updateWarranty(Request $request, Warranty $warranty)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'retailer_name' => 'nullable|string|max:255',
            'purchase_date' => 'required|date',
            'expiry_date' => 'required|date|after:purchase_date',
            'status' => 'required|in:active,expired,void',
            'notes' => 'nullable|string',
        ]);

        $warranty->update($validated);
        return redirect()->route('admin.warranties')->with('success', 'Warranty updated successfully.');
    }

    public function deleteWarranty(Warranty $warranty)
    {
        $warranty->delete();
        return redirect()->route('admin.warranties')->with('success', 'Warranty deleted successfully.');
    }

    // Products
    public function products()
    {
        $products = Product::with('category')->orderBy('display_order')->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        $categories = ProductCategory::active()->orderBy('display_order')->get();
        return view('admin.products.form', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|in:Lenz Breeze,EYE MEK',
            'category_id' => 'nullable|exists:product_categories,id',
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);
        return redirect()->route('admin.products')->with('success', 'Product created successfully.');
    }

    public function editProduct(Product $product)
    {
        $categories = ProductCategory::active()->orderBy('display_order')->get();
        return view('admin.products.form', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|in:Lenz Breeze,EYE MEK',
            'category_id' => 'nullable|exists:product_categories,id',
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);
        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }

    // Inquiries
    public function inquiries(Request $request)
    {
        $query = Inquiry::latest();
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        $inquiries = $query->paginate(20);
        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function showInquiry(Inquiry $inquiry)
    {
        if ($inquiry->status === 'new') {
            $inquiry->update(['status' => 'read']);
        }
        return view('admin.inquiries.show', compact('inquiry'));
    }

    // Subscribers
    public function subscribers()
    {
        $subscribers = Subscriber::latest()->paginate(20);
        return view('admin.subscribers', compact('subscribers'));
    }

    public function exportSubscribers()
    {
        $subscribers = Subscriber::where('status', 'active')->get();
        $csv = "Name,Email,Subscribed At\n";
        foreach ($subscribers as $sub) {
            $csv .= "\"{$sub->name}\",\"{$sub->email}\",\"{$sub->subscribed_at}\"\n";
        }
        return response($csv)->header('Content-Type', 'text/csv')->header('Content-Disposition', 'attachment; filename="subscribers.csv"');
    }

    // Pages
    public function pages()
    {
        $pages = Page::all();
        return view('admin.pages.index', compact('pages'));
    }

    public function editPage(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function updatePage(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);
        $page->update($validated);
        return redirect()->route('admin.pages')->with('success', 'Page updated successfully.');
    }
}
