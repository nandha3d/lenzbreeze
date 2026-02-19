<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Warranty extends Model
{
    protected $fillable = [
        'serial_number',
        'product_name',
        'customer_name',
        'retailer_name',
        'purchase_date',
        'expiry_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'expiry_date'   => 'date',
    ];

    /**
     * Auto-generate a unique serial number on creation.
     */
    protected static function booted(): void
    {
        static::creating(function (Warranty $warranty) {
            if (empty($warranty->serial_number)) {
                $warranty->serial_number = 'LB-' . strtoupper(Str::random(8));
            }
        });
    }

    /**
     * Check if the warranty is currently valid.
     */
    public function isValid(): bool
    {
        return $this->status === 'active' && $this->expiry_date->isFuture();
    }

    /**
     * Get the full warranty verification URL.
     */
    public function getVerificationUrl(): string
    {
        return url('/warranty?serial=' . $this->serial_number);
    }
}
