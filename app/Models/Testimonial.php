<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'name',
        'name_en',
        'name_bn',
        'position',
        'position_en',
        'position_bn',
        'company',
        'company_en',
        'company_bn',
        'image',
        'content',
        'content_en',
        'content_bn',
        'rating',
        'is_published',
        'is_featured',
        'sort_order',
    ];

    protected array $translatable = [
        'name',
        'position',
        'company',
        'content',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getStarsAttribute(): array
    {
        return array_fill(0, $this->rating, true);
    }
}
