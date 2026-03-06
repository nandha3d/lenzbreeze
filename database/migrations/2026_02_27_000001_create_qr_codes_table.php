<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qr_codes', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->text('content');           // URL or text to encode
            $table->string('fg_color', 7)->default('#003b3c'); // hex colour
            $table->unsignedSmallInteger('size')->default(256); // px (128|256|512)
            $table->unsignedBigInteger('scan_count')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qr_codes');
    }
};
