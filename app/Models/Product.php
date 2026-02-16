<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'brand', 'name', 'slug', 'tagline', 'description',
        'features', 'specifications', 'technologies', 'image', 'gallery',
        'brochure_pdf', 'is_featured', 'display_order', 'is_active',
        'meta_title', 'meta_description',
    ];

    protected $casts = [
        'features' => 'array',
        'specifications' => 'array',
        'technologies' => 'array',
        'gallery' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByBrand($query, string $brand)
    {
        return $query->where('brand', $brand);
    }
}
