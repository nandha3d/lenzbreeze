<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class WebProduct extends Model
{
    protected $table = 'web_products';
    
    protected $fillable = [
        'category_id', 'brand', 'name', 'slug', 'tagline', 'description', 
        'features', 'specifications', 'technologies', 'image', 'gallery', 
        'brochure_pdf', 'is_featured', 'display_order', 'is_active', 
        'meta_title', 'meta_description'
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

    public function scopeActiveStandard($query)
    {
        return $query->where('is_active', true)->whereNotNull('slug');
    }

    public function scopeActiveFeatured($query)
    {
        return $query->where('is_active', true)->where('is_featured', true);
    }
}
