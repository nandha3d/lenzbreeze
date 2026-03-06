<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Tables in lenzbreeze
$lenz_tables = \Illuminate\Support\Facades\DB::connection('mysql')->select('SHOW TABLES');
// Tables in salepro
$sale_tables = \Illuminate\Support\Facades\DB::connection('salepro')->select('SHOW TABLES');

$lenz_t = array_map(function($t) { return array_values((array)$t)[0]; }, $lenz_tables);
$sale_t = array_map(function($t) { return array_values((array)$t)[0]; }, $sale_tables);

echo "LenzBreeze Tables:\n";
print_r($lenz_t);

echo "\nSalePro Tables:\n";
print_r($sale_t);

// Common tables
$common = array_intersect($lenz_t, $sale_t);
echo "\nCommon Tables: \n";
print_r($common);
