<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Retailer extends Model
{
    protected $fillable = [
        'name',
        'owner_name',
        'phone',
        'address',
        'city',
        'state',
        'retailer_code',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Auto-generate retailer_code on creation (RET-001, RET-002...).
     */
    protected static function booted(): void
    {
        static::creating(function (Retailer $retailer) {
            if (empty($retailer->retailer_code)) {
                $lastCode = static::max('id') ?? 0;
                $retailer->retailer_code = 'RET-' . str_pad($lastCode + 1, 3, '0', STR_PAD_LEFT);
            }
        });
    }

    // ─── Relationships ───────────────────────────────────────────────
    public function warranties(): HasMany
    {
        return $this->hasMany(Warranty::class);
    }

    // ─── Scopes ──────────────────────────────────────────────────────
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // ─── Accessors ───────────────────────────────────────────────────
    public function getWarrantyCountAttribute(): int
    {
        return $this->warranties()->count();
    }

    public function getDisplayNameAttribute(): string
    {
        return "{$this->name} ({$this->retailer_code})";
    }
}
