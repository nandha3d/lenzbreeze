<?php
/**
 * Debug script to test SalePro AJAX endpoints.
 * Access via: http://127.0.0.1:8000/debug_ajax.php
 * DELETE THIS FILE after debugging.
 */

// Bootstrap Laravel properly
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

// Boot the kernel to initialize facades
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = \Illuminate\Http\Request::capture()
);

echo "<h2>SalePro AJAX Debug</h2>";

// Test 1: Database connection
echo "<h3>1. Database Connection</h3>";
try {
    $count = \Illuminate\Support\Facades\DB::connection('salepro')->table('products')->where('is_active', true)->count();
    echo "<p style='color:green'>✅ SalePro DB connected. Active products count: <strong>{$count}</strong></p>";
} catch (\Exception $e) {
    echo "<p style='color:red'>❌ DB Error: " . $e->getMessage() . "</p>";
}

// Test 2: Check if Product model resolves
echo "<h3>2. Product Model</h3>";
try {
    // Switch default connection
    \Illuminate\Support\Facades\Config::set('database.default', 'salepro');

    $product = \App\Models\Product::where('is_active', true)->first();
    echo "<p style='color:green'>✅ Product model works. First product: " . ($product ? $product->name . ' [' . $product->code . ']' : 'No products found') . "</p>";
} catch (\Exception $e) {
    echo "<p style='color:red'>❌ Model Error: " . $e->getMessage() . "</p>";
}

// Test 3: Check Product model connection
echo "<h3>3. Product Model Connection</h3>";
try {
    $product = new \App\Models\Product();
    $conn = $product->getConnectionName() ?: 'default (' . config('database.default') . ')';
    echo "<p>Product model uses connection: <strong>{$conn}</strong></p>";
} catch (\Exception $e) {
    echo "<p style='color:red'>❌ Error: " . $e->getMessage() . "</p>";
}

// Test 4: Check CustomField model
echo "<h3>4. CustomField Model</h3>";
try {
    $customFields = \App\Models\CustomField::where([
        ['belongs_to', 'product'],
        ['is_table', true]
    ])->pluck('name');
    echo "<p style='color:green'>✅ CustomField works. Fields: " . ($customFields->count() ? $customFields->implode(', ') : '(none)') . "</p>";
} catch (\Exception $e) {
    echo "<p style='color:red'>❌ CustomField Error: " . $e->getMessage() . "</p>";
}

// Test 5: Simulate the productData query
echo "<h3>5. Simulated productData Query</h3>";
try {
    $totalData = \Illuminate\Support\Facades\DB::connection('salepro')->table('products')->where('is_active', true)->count();
    $products = \App\Models\Product::with('category', 'brand', 'unit')
        ->where('is_active', true)
        ->limit(3)
        ->orderBy('name', 'asc')
        ->get();

    echo "<p style='color:green'>✅ Query works. Total: {$totalData}, Fetched: " . $products->count() . "</p>";

    if ($products->count() > 0) {
        echo "<table border='1' cellpadding='5' style='border-collapse:collapse;margin:10px 0'>";
        echo "<tr><th>Name</th><th>Code</th><th>Category</th><th>Brand</th><th>Price</th></tr>";
        foreach ($products as $p) {
            echo "<tr>";
            echo "<td>" . e($p->name) . "</td>";
            echo "<td>" . e($p->code) . "</td>";
            echo "<td>" . ($p->category ? e($p->category->name) : '-') . "</td>";
            echo "<td>" . ($p->brand ? e($p->brand->title) : '-') . "</td>";
            echo "<td>" . e($p->price) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
} catch (\Exception $e) {
    echo "<p style='color:red'>❌ ProductData Error: " . $e->getMessage() . "</p>";
    echo "<pre style='background:#fee;padding:10px;border-radius:8px;font-size:12px'>" . $e->getTraceAsString() . "</pre>";
}

// Test 6: Check the product-data route
echo "<h3>6. Route Info</h3>";
try {
    $routes = app('router')->getRoutes();
    foreach ($routes as $r) {
        if (str_contains($r->uri(), 'products/product-data')) {
            echo "<p>URI: <strong>" . $r->uri() . "</strong></p>";
            echo "<p>Methods: " . implode(', ', $r->methods()) . "</p>";
            echo "<p>Middleware: " . implode(', ', $r->middleware()) . "</p>";
            echo "<p>Controller: " . $r->getActionName() . "</p>";
            break;
        }
    }
} catch (\Exception $e) {
    echo "<p style='color:red'>❌ Error: " . $e->getMessage() . "</p>";
}

echo "<hr><h3>Summary</h3>";
echo "<p>If all tests pass, the DataTables error is likely caused by:</p>";
echo "<ul>";
echo "<li><strong>CSRF token mismatch</strong> — check if <code>&lt;meta name='csrf-token'&gt;</code> exists in the page head</li>";
echo "<li><strong>Auth middleware redirect</strong> — the POST returns a 302 redirect to login (HTML, not JSON)</li>";
echo "<li><strong>PHP warning/notice</strong> — Some PHP output (echo/dd/notice) corrupts the JSON response</li>";
echo "</ul>";
echo "<p style='color:gray;font-size:12px'>Delete this file after debugging: public/debug_ajax.php</p>";

$kernel->terminate($request, $response);
