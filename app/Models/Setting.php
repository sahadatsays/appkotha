<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'group',
        'key',
        'value',
        'type',
        'label',
        'description',
        'sort_order',
    ];

    /**
     * Cache key for settings.
     */
    protected const CACHE_KEY = 'app_settings';

    /**
     * Cache duration in seconds (1 hour).
     */
    protected const CACHE_TTL = 3600;

    /**
     * Get all settings as a grouped array.
     */
    public static function getAllGrouped(): array
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            $settings = self::orderBy('sort_order')->get();

            $grouped = [];
            foreach ($settings as $setting) {
                $grouped[$setting->group][$setting->key] = $setting->value;
            }

            return $grouped;
        });
    }

    /**
     * Get a specific setting value.
     */
    public static function getValue(string $group, string $key, $default = null)
    {
        $settings = self::getAllGrouped();
        return $settings[$group][$key] ?? $default;
    }

    /**
     * Get all settings for a specific group.
     */
    public static function getGroup(string $group): array
    {
        $settings = self::getAllGrouped();
        return $settings[$group] ?? [];
    }

    /**
     * Set a setting value.
     */
    public static function setValue(string $group, string $key, $value, array $attributes = []): self
    {
        $setting = self::updateOrCreate(
            ['group' => $group, 'key' => $key],
            array_merge(['value' => $value], $attributes)
        );

        self::clearCache();

        return $setting;
    }

    /**
     * Clear the settings cache.
     */
    public static function clearCache(): void
    {
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Boot method to clear cache on changes.
     */
    protected static function boot()
    {
        parent::boot();

        static::saved(function () {
            self::clearCache();
        });

        static::deleted(function () {
            self::clearCache();
        });
    }

    /**
     * Get available groups.
     */
    public static function getGroups(): array
    {
        return [
            'company' => 'Company Information',
            'hero' => 'Hero Section',
            'colors' => 'Color Configuration',
            'social' => 'Social Media',
            'seo' => 'SEO Settings',
            'contact' => 'Contact Information',
            'stats' => 'Statistics',
        ];
    }

    /**
     * Get available types.
     */
    public static function getTypes(): array
    {
        return [
            'text' => 'Text',
            'textarea' => 'Text Area',
            'richtext' => 'Rich Text',
            'image' => 'Image',
            'color' => 'Color',
            'number' => 'Number',
            'boolean' => 'Boolean',
            'json' => 'JSON',
            'url' => 'URL',
        ];
    }

    /**
     * Get typed value based on setting type.
     */
    public function getTypedValueAttribute()
    {
        return match($this->type) {
            'boolean' => filter_var($this->value, FILTER_VALIDATE_BOOLEAN),
            'number' => is_numeric($this->value) ? (float) $this->value : null,
            'json' => json_decode($this->value, true),
            default => $this->value,
        };
    }
}
