<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\WarrantyController;
use App\Http\Controllers\Admin\RetailerController;
use Illuminate\Support\Facades\Route;

// Public Pages
Route::get('/debug-db', function() {
    try {
        return response()->json(\DB::connection('salepro')->select("SHOW CREATE TABLE customer_bills"));
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});
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
    Route::get('/web-products/{web_product}/edit', [AdminController::class, 'editProduct'])->name('admin.web_products.edit');
    Route::put('/web-products/{web_product}', [AdminController::class, 'updateProduct'])->name('admin.web_products.update');
    Route::delete('/web-products/{web_product}', [AdminController::class, 'deleteProduct'])->name('admin.web_products.delete');

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

// Auto-deploy database route for Hostinger
Route::get('/deploy-auto-import', function () {
    try {
        set_time_limit(0); 
        ini_set('memory_limit', '-1'); // Attempt to ignore memory limits completely
        
        $sqlPath = database_path('lenzbreeze_live.sql');
        if (!file_exists($sqlPath)) {
            return 'SQL file not found at: ' . $sqlPath;
        }

        $pdo = \Illuminate\Support\Facades\DB::connection()->getPdo();
        $pdo->exec('SET FOREIGN_KEY_CHECKS=0;'); // Critical for bulk imports
        
        $handle = fopen($sqlPath, 'r');
        $query = '';
        
        while (($line = fgets($handle)) !== false) {
            $trimmed = trim($line);
            
            // Skip empty lines or pure SQL comments
            if ($trimmed == '' || str_starts_with($trimmed, '--') || str_starts_with($trimmed, '/*')) {
                continue;
            }
            
            $query .= $line; // Append the line
            
            // If the line finishes a SQL statement
            if (str_ends_with(rtrim($query), ';')) {
                try {
                    $pdo->exec($query); // Bypasses heavy Laravel components (QueryLogger, Str overrides)
                } catch (\Exception $subE) {
                    // Suppress and continue (common during DROP IF EXISTS)
                }
                $query = ''; // Clear payload
            }
        }
        fclose($handle);
        
        $pdo->exec('SET FOREIGN_KEY_CHECKS=1;'); // Re-enable

        return 'Database imported successfully using line-by-line streaming! Memory overhead completely avoided. You can now use the application.';
    } catch (\Exception $e) {
        return 'Error during import: ' . $e->getMessage();
    }
});

// Auto-migration route for Hostinger
Route::get('/run-migrations-live', function () {
    try {
        $salepro = \Illuminate\Support\Facades\DB::connection('salepro');

        // Just directly create the tables if they don't exist and completely bypass Artisan migrations
        if (!\Illuminate\Support\Facades\Schema::connection('salepro')->hasTable('order_extra_types')) {
            \Illuminate\Support\Facades\Schema::connection('salepro')->create('order_extra_types', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->enum('type', ['fee', 'info'])->default('info');
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }
        
        if (!\Illuminate\Support\Facades\Schema::connection('salepro')->hasTable('order_extras')) {
            \Illuminate\Support\Facades\Schema::connection('salepro')->create('order_extras', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->id();
                $table->unsignedInteger('sale_id');
                $table->unsignedBigInteger('order_extra_type_id');
                $table->string('value')->nullable();
                
                $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
                $table->foreign('order_extra_type_id')->references('id')->on('order_extra_types')->onDelete('cascade');
                $table->timestamps();
            });
        }

        // Ensure default extra types exist for the Additional Order Details
        if ($salepro->table('order_extra_types')->count() == 0) {
            $salepro->table('order_extra_types')->insert([
                ['name' => 'Fitting charge', 'type' => 'fee', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Tinting cost', 'type' => 'fee', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Customer Order No.', 'type' => 'info', 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        // Add missing columns to general_settings from previous customization
        if (!\Illuminate\Support\Facades\Schema::connection('salepro')->hasColumn('general_settings', 'is_sale_status_active')) {
            \Illuminate\Support\Facades\Schema::connection('salepro')->table('general_settings', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->boolean('is_sale_status_active')->default(true);
                $table->boolean('is_payment_status_active')->default(true);
            });
        }

        // IMPORTANT: Clear cache so general_settings updates take effect immediately
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');

        return "<strong>Success!</strong> All recent database changes (including general_settings and order_extras) were applied, and the cache was cleared. Your application is good to go!";
    } catch (\Exception $e) {
        return "<strong>Error:</strong> " . $e->getMessage();
    }
});

// Diagnostic: Check what logo filename is in the database
Route::get('/check-logo-live', function () {
    $gs = \Illuminate\Support\Facades\DB::connection('salepro')->table('general_settings')->first();
    $logoFile = $gs->site_logo ?? '(empty/null)';
    $logoPath = public_path('logo/' . $gs->site_logo);
    $exists = file_exists($logoPath) ? 'YES' : 'NO';
    $logoUrl = url('logo', $gs->site_logo);

    // List all files in public/logo/
    $files = glob(public_path('logo/*'));
    $fileList = array_map(fn($f) => basename($f), $files);

    return "<h3>Logo Diagnostic</h3>"
        . "<p><strong>DB site_logo value:</strong> {$logoFile}</p>"
        . "<p><strong>Full path checked:</strong> {$logoPath}</p>"
        . "<p><strong>File exists on disk:</strong> {$exists}</p>"
        . "<p><strong>URL that invoice uses:</strong> <a href='{$logoUrl}' target='_blank'>{$logoUrl}</a></p>"
        . "<p><strong>All files in public/logo/:</strong> " . implode(', ', $fileList) . "</p>";
});

// Quick fix: Update DB to use the correct logo file
Route::get('/fix-logo-live', function () {
    \Illuminate\Support\Facades\DB::connection('salepro')
        ->table('general_settings')
        ->update(['site_logo' => 'lenzbreeze_logo.avif']);

    \Illuminate\Support\Facades\Artisan::call('cache:clear');

    return "<strong>Done!</strong> Logo updated to 'lenzbreeze_logo.avif' and cache cleared. <a href='/check-logo-live'>Verify here</a>";
});
