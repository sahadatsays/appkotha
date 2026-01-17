<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'tagline',
        'short_description',
        'description',
        'features',
        'use_cases',
        'price',
        'sale_price',
        'license_type',
        'demo_url',
        'documentation_url',
        'icon',
        'image',
        'is_published',
        'is_featured',
        'published_at',
        'meta_title',
        'meta_description',
        'sort_order',
    ];

    protected $casts = [
        'features' => 'array',
        'use_cases' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'price' => 'decimal:2',
        'sale_price' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->where(function ($q) {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getFormattedPriceAttribute(): string
    {
        $price = $this->sale_price ?? $this->price;
        return '৳' . number_format((float) $price, 0);
    }

    public function getOriginalPriceAttribute(): ?string
    {
        if ($this->sale_price && $this->price) {
            return '৳' . number_format((float) $this->price, 0);
        }
        return null;
    }

    public function getLicenseLabelAttribute(): string
    {
        return match($this->license_type) {
            'monthly' => '/month',
            'yearly' => '/year',
            'lifetime' => 'lifetime',
            default => '',
        };
    }
}
