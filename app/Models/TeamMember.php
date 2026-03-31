<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TeamMember extends Model
{
    /** @use HasFactory<\Database\Factories\TeamMemberFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'designation',
        'short_bio',
        'full_bio',
        'profile_image',
        'cover_image',
        'email',
        'phone',
        'location',
        'skills',
        'social_links',
        'experience_years',
        'is_featured',
        'status',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'skills' => 'array',
            'social_links' => 'array',
            'is_featured' => 'boolean',
            'status' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (TeamMember $teamMember): void {
            if (blank($teamMember->slug)) {
                $teamMember->slug = Str::slug($teamMember->name);
            }
        });
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
