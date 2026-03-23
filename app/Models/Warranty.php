<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Warranty extends Model
{
    // ─── Status Constants ────────────────────────────────────────────
    const STATUS_ACTIVE      = 'active';
    const STATUS_EXPIRED     = 'expired';
    const STATUS_UNDER_CLAIM = 'under_claim';
    const STATUS_APPROVED    = 'approved';
    const STATUS_REJECTED    = 'rejected';
    const STATUS_RESOLVED    = 'resolved';
    const STATUS_VOID        = 'void';

    const STATUSES = [
        self::STATUS_ACTIVE,
        self::STATUS_EXPIRED,
        self::STATUS_UNDER_CLAIM,
        self::STATUS_APPROVED,
        self::STATUS_REJECTED,
        self::STATUS_RESOLVED,
        self::STATUS_VOID,
    ];

    const CLAIM_STATUSES = [
        self::STATUS_UNDER_CLAIM,
        self::STATUS_APPROVED,
        self::STATUS_REJECTED,
        self::STATUS_RESOLVED,
    ];

    protected $fillable = [
        'sale_id',
        'sale_order_no',
        'serial_number',
        'product_name',
        'customer_name', // End User Name
        'customer_phone', // End User Phone
        'customer_email', // End User Email
        'customer_address', // End User Address
        'customer_photo',
        'store_id', // SalePro Customer ID (Store)
        'retailer_name', // Denormalized Store Name
        'right_eye_sph', 'right_eye_cyl', 'right_eye_axis', 'right_eye_add',
        'left_eye_sph', 'left_eye_cyl', 'left_eye_axis', 'left_eye_add',
        'pupillary_distance',
        'lens_type',
        'lens_coating',
        'lens_index',
        'manufacturing_date',
        'batch_number',
        'purchase_date',
        'expiry_date',
        'warranty_months',
        'status',
        'notes',
        'claim_date',
        'claim_notes',
    ];

    protected $casts = [
        'purchase_date'      => 'date',
        'expiry_date'        => 'date',
        'manufacturing_date' => 'date',
        'claim_date'         => 'date',
        'right_eye_sph'      => 'decimal:2',
        'right_eye_cyl'      => 'decimal:2',
        'right_eye_add'      => 'decimal:2',
        'left_eye_sph'       => 'decimal:2',
        'left_eye_cyl'       => 'decimal:2',
        'left_eye_add'       => 'decimal:2',
        'pupillary_distance' => 'decimal:1',
        'store_id'           => 'integer',
        'warranty_months'    => 'integer',
    ];

    // ─── Boot ────────────────────────────────────────────────────────
    protected static function booted(): void
    {
        static::creating(function (Warranty $warranty) {
            if (empty($warranty->serial_number)) {
                $warranty->serial_number = 'LB-' . strtoupper(Str::random(8));
            }
        });
    }

    // ─── Relationships ───────────────────────────────────────────────
    public function store(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'store_id');
    }

    public function retailer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'store_id');
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class)->withDefault();
    }

    // ─── Status Helpers ──────────────────────────────────────────────
    public function isValid(): bool
    {
        return $this->status === self::STATUS_ACTIVE && $this->expiry_date->isFuture();
    }

    public function isExpired(): bool
    {
        return $this->status === self::STATUS_EXPIRED || $this->expiry_date->isPast();
    }

    public function isUnderClaim(): bool
    {
        return in_array($this->status, self::CLAIM_STATUSES);
    }

    public function getEffectiveStatusAttribute(): string
    {
        if ($this->status === self::STATUS_ACTIVE && $this->expiry_date && $this->expiry_date->isPast()) {
            return self::STATUS_EXPIRED;
        }
        return $this->status;
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->effective_status) {
            self::STATUS_ACTIVE      => 'green',
            self::STATUS_EXPIRED     => 'red',
            self::STATUS_UNDER_CLAIM => 'amber',
            self::STATUS_APPROVED    => 'blue',
            self::STATUS_REJECTED    => 'red',
            self::STATUS_RESOLVED    => 'teal',
            self::STATUS_VOID        => 'gray',
            default                  => 'gray',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->effective_status) {
            self::STATUS_ACTIVE      => 'Active',
            self::STATUS_EXPIRED     => 'Expired',
            self::STATUS_UNDER_CLAIM => 'Under Claim',
            self::STATUS_APPROVED    => 'Approved',
            self::STATUS_REJECTED    => 'Rejected',
            self::STATUS_RESOLVED    => 'Resolved',
            self::STATUS_VOID        => 'Void',
            default                  => ucfirst($this->status),
        };
    }

    // ─── Scopes ──────────────────────────────────────────────────────
    public function scopeExpiringSoon($query, int $days = 30)
    {
        return $query->where('status', self::STATUS_ACTIVE)
                     ->whereBetween('expiry_date', [now(), now()->addDays($days)]);
    }

    public function scopeWithClaims($query)
    {
        return $query->whereIn('status', self::CLAIM_STATUSES);
    }

    public function scopeSearch($query, ?string $term)
    {
        if (!$term) return $query;
        return $query->where(function ($q) use ($term) {
            $q->where('serial_number', 'like', "%{$term}%")
              ->orWhere('customer_name', 'like', "%{$term}%")
              ->orWhere('customer_phone', 'like', "%{$term}%");
        });
    }

    // ─── Helpers ─────────────────────────────────────────────────────
    public function getVerificationUrl(): string
    {
        return url('/warranty?serial=' . $this->serial_number);
    }

    public function getCustomerPhotoUrlAttribute(): ?string
    {
        return $this->customer_photo ? asset('storage/' . $this->customer_photo) : null;
    }
}
