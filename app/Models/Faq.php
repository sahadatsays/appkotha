<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = [
        'question',
        'question_en',
        'question_bn',
        'answer',
        'answer_en',
        'answer_bn',
        'category',
        'is_published',
        'is_featured',
        'sort_order',
    ];

    protected array $translatable = [
        'question',
        'answer',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Scope for published FAQs.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope for featured FAQs.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope by category.
     */
    public function scopeInCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope ordered by sort order.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /**
     * Get available categories.
     */
    public static function getCategories(): array
    {
        return [
            'general' => 'General',
            'products' => 'Products',
            'services' => 'Services',
            'payment' => 'Payment & Billing',
            'support' => 'Support',
            'technical' => 'Technical',
        ];
    }
}
