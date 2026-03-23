<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebProduct;
use App\Models\ProductCategory;
use App\Models\Inquiry;
use App\Models\Subscriber;
use App\Models\Page;
use App\Models\Warranty;
use App\Models\Retailer;
use App\Models\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        return redirect('/admin/dashboard');
    }

    // Products
    public function products()
    {
        $products = WebProduct::with('category')->latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        $categories = ProductCategory::active()->latest()->get();
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

        WebProduct::create($validated);
        return redirect()->route('admin.web_products')->with('success', 'Product created successfully.');
    }

    public function editProduct(WebProduct $web_product)
    {
        $categories = ProductCategory::active()->orderBy('display_order')->get();
        return view('admin.products.form', compact('web_product', 'categories'));
    }

    public function updateProduct(Request $request, WebProduct $web_product)
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

        $web_product->update($validated);
        return redirect()->route('admin.web_products')->with('success', 'Product updated successfully.');
    }

    public function deleteProduct(WebProduct $web_product)
    {
        $web_product->delete();
        return redirect()->route('admin.web_products')->with('success', 'Product deleted successfully.');
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

    // ─── QR Codes ────────────────────────────────────────────────────────────

    public function qrCodes(Request $request)
    {
        $query = QrCode::latest();
        if ($request->filled('search')) {
            $query->where('label', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }
        $qrCodes = $query->paginate(24);
        return view('admin.qrcodes.index', compact('qrCodes'));
    }

    public function createQrCode()
    {
        return view('admin.qrcodes.create');
    }

    public function storeQrCode(Request $request)
    {
        $validated = $request->validate([
            'label'    => 'required|string|max:255',
            'content'  => 'required|string|max:2048',
            'fg_color' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
            'size'     => 'required|in:256,512,1024,2048',
        ]);

        $qrCode = QrCode::create($validated);
        return redirect()->route('admin.qrcodes.show', $qrCode)
                         ->with('success', 'QR Code created successfully.');
    }

    public function showQrCode(QrCode $qrCode)
    {
        return view('admin.qrcodes.show', compact('qrCode'));
    }

    public function editQrCode(QrCode $qrCode)
    {
        return view('admin.qrcodes.edit', compact('qrCode'));
    }

    public function updateQrCode(Request $request, QrCode $qrCode)
    {
        $validated = $request->validate([
            'label'    => 'required|string|max:255',
            'content'  => 'required|string|max:2048',
            'fg_color' => 'required|regex:/^#[0-9A-Fa-f]{6}$/',
            'size'     => 'required|in:256,512,1024,2048',
        ]);

        $qrCode->update($validated);
        return redirect()->route('admin.qrcodes.show', $qrCode)
                         ->with('success', 'QR Code updated successfully.');
    }

    public function destroyQrCode(QrCode $qrCode)
    {
        $qrCode->delete();
        return redirect()->route('admin.qrcodes')
                         ->with('success', 'QR Code deleted.');
    }
}
