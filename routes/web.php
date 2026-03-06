<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\WarrantyController;
use App\Http\Controllers\Admin\RetailerController;
use Illuminate\Support\Facades\Route;

// Public Pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/home-v1', [PageController::class, 'homeV1'])->name('home.v1');
Route::get('/home-v2', [PageController::class, 'homeV2'])->name('home.v2');
Route::get('/home-v3', [PageController::class, 'homeV3'])->name('home.v3');
Route::get('/home-v4', [PageController::class, 'homeV4'])->name('home.v4');
Route::get('/home-v5', [PageController::class, 'homeV5'])->name('home.v5');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/products/category/{slug}', [PageController::class, 'productsByCategory'])->name('products.category');
Route::get('/products/{slug}', [PageController::class, 'productShow'])->name('products.show');
Route::get('/facilities', [PageController::class, 'facilities'])->name('facilities');
Route::get('/technologies', [PageController::class, 'technologies'])->name('technologies');
Route::get('/partners', [PageController::class, 'partners'])->name('partners');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-conditions', [PageController::class, 'terms'])->name('terms');
Route::get('/warranty', [PageController::class, 'warranty'])->name('warranty');
Route::get('/tinting-chart', [PageController::class, 'tintingChart'])->name('tinting-chart');

// Admin Routes
Route::prefix('admin')->middleware(['auth', \App\Http\Middleware\AdminAccess::class, \App\Http\Middleware\LoadSaleProPermissions::class])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.web_dashboard');

    // Web Products (LenzBreeze)
    Route::get('/web-products', [AdminController::class, 'products'])->name('admin.web_products');
    Route::get('/web-products/create', [AdminController::class, 'createProduct'])->name('admin.web_products.create');
    Route::post('/web-products', [AdminController::class, 'storeProduct'])->name('admin.web_products.store');
    Route::get('/web-products/{product}/edit', [AdminController::class, 'editProduct'])->name('admin.web_products.edit');
    Route::put('/web-products/{product}', [AdminController::class, 'updateProduct'])->name('admin.web_products.update');
    Route::delete('/web-products/{product}', [AdminController::class, 'deleteProduct'])->name('admin.web_products.delete');

    // Inquiries
    Route::get('/inquiries', [AdminController::class, 'inquiries'])->name('admin.web_inquiries');
    Route::get('/inquiries/{inquiry}', [AdminController::class, 'showInquiry'])->name('admin.web_inquiries.show');

    // Subscribers
    Route::get('/subscribers', [AdminController::class, 'subscribers'])->name('subscribers');
    Route::get('/subscribers/export', [AdminController::class, 'exportSubscribers'])->name('subscribers.export');

    // Pages
    Route::get('/pages', [AdminController::class, 'pages'])->name('admin.web_pages');
    Route::get('/pages/{page}/edit', [AdminController::class, 'editPage'])->name('admin.web_pages.edit');
    Route::put('/pages/{page}', [AdminController::class, 'updatePage'])->name('admin.web_pages.update');

    // QR Codes
    Route::get('/qrcodes', [AdminController::class, 'qrCodes'])->name('admin.qrcodes');
    Route::get('/qrcodes/create', [AdminController::class, 'createQrCode'])->name('admin.qrcodes.create');
    Route::post('/qrcodes', [AdminController::class, 'storeQrCode'])->name('admin.qrcodes.store');
    Route::get('/qrcodes/{qrCode}', [AdminController::class, 'showQrCode'])->name('admin.qrcodes.show');
    Route::get('/qrcodes/{qrCode}/edit', [AdminController::class, 'editQrCode'])->name('admin.qrcodes.edit');
    Route::put('/qrcodes/{qrCode}', [AdminController::class, 'updateQrCode'])->name('admin.qrcodes.update');
    Route::delete('/qrcodes/{qrCode}', [AdminController::class, 'destroyQrCode'])->name('admin.qrcodes.destroy');

    // Warranties (dedicated controller)
    Route::get('/warranties', [WarrantyController::class, 'index'])->name('admin.warranties');
    Route::get('/warranties/create', [WarrantyController::class, 'create'])->name('admin.warranties.create');
    Route::post('/warranties/serial-lookup', [WarrantyController::class, 'serialLookup'])->name('admin.warranties.serial-lookup');
    Route::post('/warranties/order-lookup', [WarrantyController::class, 'orderLookup'])->name('admin.warranties.order-lookup');
    Route::post('/warranties', [WarrantyController::class, 'store'])->name('admin.warranties.store');
    Route::get('/warranties/{warranty}', [WarrantyController::class, 'show'])->name('admin.warranties.show');
    Route::get('/warranties/{warranty}/edit', [WarrantyController::class, 'edit'])->name('admin.warranties.edit');
    Route::put('/warranties/{warranty}', [WarrantyController::class, 'update'])->name('admin.warranties.update');
    Route::delete('/warranties/{warranty}', [WarrantyController::class, 'destroy'])->name('admin.warranties.delete');

    // Retailers
    Route::get('/retailers', [RetailerController::class, 'index'])->name('admin.retailers');
    Route::get('/retailers/create', [RetailerController::class, 'create'])->name('admin.retailers.create');
    Route::post('/retailers', [RetailerController::class, 'store'])->name('admin.retailers.store');
    Route::get('/retailers/{retailer}/edit', [RetailerController::class, 'edit'])->name('admin.retailers.edit');
    Route::put('/retailers/{retailer}', [RetailerController::class, 'update'])->name('admin.retailers.update');
    Route::post('/retailers/{retailer}/toggle', [RetailerController::class, 'toggleActive'])->name('admin.retailers.toggle');
});

// Auth routes — unified to use SalePro's login system
Route::get('/dashboard', function () {
    return redirect('/admin/dashboard');
});

Route::get('/login', function () {
    return redirect('/admin/login');
})->name('login')->middleware('guest');
    
Route::post('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Merge SalePro Routes here:
// SalePro routes are loaded natively in bootstrap/app.php
