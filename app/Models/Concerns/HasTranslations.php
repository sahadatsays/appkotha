<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasTranslations
{
    public function getAttribute($key): mixed
    {
        if (! is_string($key)) {
            return parent::getAttribute($key);
        }

        if ($this->isTranslatableAttribute($key)) {
            return $this->translated($key);
        }

        if (Str::endsWith($key, '_translated')) {
            $baseAttribute = Str::beforeLast($key, '_translated');

            if ($this->isTranslatableAttribute($baseAttribute)) {
                return $this->translated($baseAttribute);
            }
        }

        return parent::getAttribute($key);
    }

    public function translated(string $attribute, ?string $locale = null): mixed
    {
        if (! $this->isTranslatableAttribute($attribute)) {
            return parent::getAttribute($attribute);
        }

        $resolvedLocale = $locale ?? app()->getLocale();
        $fallbackLocale = 'en';

        $localizedValue = parent::getAttribute($attribute.'_'.$resolvedLocale);
        if ($this->hasTranslatedValue($localizedValue)) {
            return $localizedValue;
        }

        $fallbackValue = parent::getAttribute($attribute.'_'.$fallbackLocale);
        if ($this->hasTranslatedValue($fallbackValue)) {
            return $fallbackValue;
        }

        return parent::getAttribute($attribute);
    }

    protected function hasTranslatedValue(mixed $value): bool
    {
        if (is_string($value)) {
            return trim($value) !== '';
        }

        return ! is_null($value);
    }

    protected function isTranslatableAttribute(string $attribute): bool
    {
        /** @var array<int, string> $translatable */
        $translatable = $this->translatable ?? [];

        return in_array($attribute, $translatable, true);
    }
}
