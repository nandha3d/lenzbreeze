<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

// Public Pages
Route::get('/', [PageController::class, 'home'])->name('home');
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

// Admin Routes
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Products
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
    Route::put('/products/{product}', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{product}', [AdminController::class, 'deleteProduct'])->name('products.delete');

    // Inquiries
    Route::get('/inquiries', [AdminController::class, 'inquiries'])->name('inquiries');
    Route::get('/inquiries/{inquiry}', [AdminController::class, 'showInquiry'])->name('inquiries.show');

    // Subscribers
    Route::get('/subscribers', [AdminController::class, 'subscribers'])->name('subscribers');
    Route::get('/subscribers/export', [AdminController::class, 'exportSubscribers'])->name('subscribers.export');

    // Pages
    Route::get('/pages', [AdminController::class, 'pages'])->name('pages');
    Route::get('/pages/{page}/edit', [AdminController::class, 'editPage'])->name('pages.edit');
    Route::put('/pages/{page}', [AdminController::class, 'updatePage'])->name('pages.update');
});

// Auth routes (simple)
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    if (\Illuminate\Support\Facades\Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/admin');
    }
    return back()->withErrors(['email' => 'Invalid credentials.']);
})->name('login.submit');

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');
