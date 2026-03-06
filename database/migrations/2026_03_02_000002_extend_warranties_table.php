<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // First, expand the status enum by recreating the column
        Schema::table('warranties', function (Blueprint $table) {
            $table->string('status_new', 20)->default('active')->after('status');
        });

        // Copy existing status values
        DB::table('warranties')->update(['status_new' => DB::raw('status')]);

        Schema::table('warranties', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('warranties', function (Blueprint $table) {
            $table->renameColumn('status_new', 'status');
        });

        // Add all new columns
        Schema::table('warranties', function (Blueprint $table) {
            // Retailer FK
            $table->unsignedBigInteger('retailer_id')->nullable()->after('id');
            $table->foreign('retailer_id')->references('id')->on('retailers')->nullOnDelete();

            // Customer details
            $table->string('customer_phone', 20)->nullable()->after('customer_name');
            $table->string('customer_email')->nullable()->after('customer_phone');
            $table->text('customer_address')->nullable()->after('customer_email');
            $table->string('customer_photo')->nullable()->after('customer_address');

            // Eye power — Right Eye
            $table->decimal('right_eye_sph', 5, 2)->nullable()->after('customer_photo');
            $table->decimal('right_eye_cyl', 5, 2)->nullable()->after('right_eye_sph');
            $table->integer('right_eye_axis')->nullable()->after('right_eye_cyl');
            $table->decimal('right_eye_add', 4, 2)->nullable()->after('right_eye_axis');

            // Eye power — Left Eye
            $table->decimal('left_eye_sph', 5, 2)->nullable()->after('right_eye_add');
            $table->decimal('left_eye_cyl', 5, 2)->nullable()->after('left_eye_sph');
            $table->integer('left_eye_axis')->nullable()->after('left_eye_cyl');
            $table->decimal('left_eye_add', 4, 2)->nullable()->after('left_eye_axis');

            // PD
            $table->decimal('pupillary_distance', 4, 1)->nullable()->after('left_eye_add');

            // Lens details
            $table->string('lens_type', 100)->nullable()->after('pupillary_distance');
            $table->string('lens_coating', 100)->nullable()->after('lens_type');
            $table->string('lens_index', 10)->nullable()->after('lens_coating');

            // Manufacturing
            $table->date('manufacturing_date')->nullable()->after('lens_index');
            $table->string('batch_number', 50)->nullable()->after('manufacturing_date');

            // Warranty duration
            $table->unsignedSmallInteger('warranty_months')->default(12)->after('batch_number');

            // Claims
            $table->date('claim_date')->nullable()->after('notes');
            $table->text('claim_notes')->nullable()->after('claim_date');

            // Indexes for performance
            $table->index('status');
            $table->index('retailer_id');
            $table->index('customer_phone');
            $table->index('expiry_date');
        });
    }

    public function down(): void
    {
        Schema::table('warranties', function (Blueprint $table) {
            $table->dropForeign(['retailer_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['retailer_id']);
            $table->dropIndex(['customer_phone']);
            $table->dropIndex(['expiry_date']);

            $table->dropColumn([
                'retailer_id',
                'customer_phone', 'customer_email', 'customer_address', 'customer_photo',
                'right_eye_sph', 'right_eye_cyl', 'right_eye_axis', 'right_eye_add',
                'left_eye_sph', 'left_eye_cyl', 'left_eye_axis', 'left_eye_add',
                'pupillary_distance',
                'lens_type', 'lens_coating', 'lens_index',
                'manufacturing_date', 'batch_number',
                'warranty_months',
                'claim_date', 'claim_notes',
            ]);
        });
    }
};
