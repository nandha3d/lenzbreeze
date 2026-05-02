<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('salepro')->table('products', function (Blueprint $table) {
            if (!Schema::connection('salepro')->hasColumn('products', 'sku')) {
                $table->string('sku')->nullable()->after('code');
            }
            if (!Schema::connection('salepro')->hasColumn('products', 'dia')) {
                $table->string('dia')->nullable()->after('sku');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('salepro')->table('products', function (Blueprint $table) {
            $table->dropColumn(['sku', 'dia']);
        });
    }
};
