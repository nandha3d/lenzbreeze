<?php

namespace App\Http\Controllers;

use App\Models\WebProduct;
use App\Models\ProductCategory;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Warranty;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return $this->renderHome('pages.home');
    }

    public function homeV1()
    {
        return $this->renderHome('pages.home-v1');
    }

    public function homeV2()
    {
        return $this->renderHome('pages.home-v2');
    }

    public function homeV3()
    {
        return $this->renderHome('pages.home-v3');
    }

    public function homeV4()
    {
        return $this->renderHome('pages.home-v4');
    }

    public function homeV5()
    {
        return $this->renderHome('pages.home-v5');
    }

    protected function renderHome($view)
    {
        $featuredProducts = WebProduct::activeFeatured()->take(4)->get();
        $categories = ProductCategory::active()->get();
        $promoProduct = WebProduct::find(1);

        return view($view, compact('featuredProducts', 'categories', 'promoProduct'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function products()
    {
        $categories = ProductCategory::active()->withCount('products')->get();
        $products = WebProduct::activeStandard()->with('category')->get();

        return view('pages.products.index', compact('categories', 'products'));
    }

    public function productsByCategory(string $slug)
    {
        $category = ProductCategory::where('slug', $slug)->firstOrFail();
        $products = WebProduct::activeStandard()->where('category_id', $category->id)->get();
        $categories = ProductCategory::active()->get();
        return view('pages.products.index', compact('category', 'products', 'categories'));
    }

    public function productShow(string $slug)
    {
        $product = WebProduct::activeStandard()->where('slug', $slug)->firstOrFail();
        $relatedProducts = WebProduct::activeStandard()->where('category_id', $product->category_id)->where('id', '!=', $product->id)->take(3)->get();
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
            $warranty = Warranty::with('retailer')->where('serial_number', $request->serial)->first();
            if (!$warranty) {
                return back()->with('error', 'No warranty found for this serial number. Please check and try again.');
            }
        }
        return view('pages.warranty', compact('warranty'));
    }

    public function tintingChart()
    {
        return view('pages.tinting-chart');
    }
}
