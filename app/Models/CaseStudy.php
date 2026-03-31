<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CaseStudy extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'title',
        'title_en',
        'title_bn',
        'slug',
        'client',
        'client_en',
        'client_bn',
        'industry',
        'industry_en',
        'industry_bn',
        'excerpt',
        'excerpt_en',
        'excerpt_bn',
        'challenge',
        'challenge_en',
        'challenge_bn',
        'solution',
        'solution_en',
        'solution_bn',
        'results',
        'results_en',
        'results_bn',
        'metrics',
        'tech_stack',
        'featured_image',
        'testimonial_quote',
        'testimonial_quote_en',
        'testimonial_quote_bn',
        'testimonial_author',
        'testimonial_author_en',
        'testimonial_author_bn',
        'testimonial_position',
        'testimonial_position_en',
        'testimonial_position_bn',
        'is_published',
        'is_featured',
        'published_at',
        'sort_order',
    ];

    protected array $translatable = [
        'title',
        'client',
        'industry',
        'excerpt',
        'challenge',
        'solution',
        'results',
        'testimonial_quote',
        'testimonial_author',
        'testimonial_position',
    ];

    protected $casts = [
        'metrics' => 'array',
        'tech_stack' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($caseStudy) {
            if (empty($caseStudy->slug)) {
                $caseStudy->slug = Str::slug($caseStudy->title_en ?? $caseStudy->title);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
