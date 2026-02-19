<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Warranty;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $featuredProducts = Product::featured()->active()->orderBy('display_order')->take(4)->get();
        $categories = ProductCategory::active()->orderBy('display_order')->get();
        return view('pages.home', compact('featuredProducts', 'categories'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function products()
    {
        $categories = ProductCategory::active()->withCount(['products' => fn($q) => $q->active()])->orderBy('display_order')->get();
        $products = Product::active()->with('category')->orderBy('display_order')->get();
        return view('pages.products.index', compact('categories', 'products'));
    }

    public function productsByCategory(string $slug)
    {
        $category = ProductCategory::where('slug', $slug)->firstOrFail();
        $products = Product::active()->where('category_id', $category->id)->orderBy('display_order')->get();
        $categories = ProductCategory::active()->orderBy('display_order')->get();
        return view('pages.products.index', compact('category', 'products', 'categories'));
    }

    public function productShow(string $slug)
    {
        $product = Product::where('slug', $slug)->active()->firstOrFail();
        $relatedProducts = Product::active()->where('category_id', $product->category_id)->where('id', '!=', $product->id)->take(3)->get();
        return view('pages.products.show', compact('product', 'relatedProducts'));
    }

    public function facilities()
    {
        return view('pages.facilities');
    }

    public function technologies()
    {
        return view('pages.technologies');
    }

    public function partners()
    {
        return view('pages.partners');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function privacy()
    {
        $page = Page::where('slug', 'privacy-policy')->first();
        return view('pages.legal', ['page' => $page, 'title' => 'Privacy Policy']);
    }

    public function terms()
    {
        $page = Page::where('slug', 'terms-conditions')->first();
        return view('pages.legal', ['page' => $page, 'title' => 'Terms & Conditions']);
    }

    public function warranty(Request $request)
    {
        $warranty = null;
        if ($request->filled('serial')) {
            $warranty = Warranty::where('serial_number', $request->serial)->first();
            if (!$warranty) {
                return back()->with('error', 'Invalid Serial Number.');
            }
        }
        return view('pages.warranty', compact('warranty'));
    }
}
