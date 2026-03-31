<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'name',
        'name_en',
        'name_bn',
        'slug',
        'tagline',
        'tagline_en',
        'tagline_bn',
        'short_description',
        'short_description_en',
        'short_description_bn',
        'description',
        'description_en',
        'description_bn',
        'process_steps',
        'starting_price',
        'icon',
        'image',
        'is_published',
        'is_featured',
        'published_at',
        'meta_title',
        'meta_title_en',
        'meta_title_bn',
        'meta_description',
        'meta_description_en',
        'meta_description_bn',
        'sort_order',
    ];

    protected array $translatable = [
        'name',
        'tagline',
        'short_description',
        'description',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'process_steps' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'starting_price' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->name_en ?? $service->name);
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
        return '৳'.number_format((float) $this->starting_price, 0);
    }
}
