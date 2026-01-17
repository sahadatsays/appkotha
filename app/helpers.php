<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    /**
     * Get a setting value.
     *
     * @param string $key The key in format 'group.key' or just 'group'
     * @param mixed $default Default value if setting not found
     * @return mixed
     */
    function setting(string $key, $default = null)
    {
        $parts = explode('.', $key);

        if (count($parts) === 2) {
            return Setting::getValue($parts[0], $parts[1], $default);
        }

        if (count($parts) === 1) {
            return Setting::getGroup($parts[0]) ?: $default;
        }

        return $default;
    }
}

if (!function_exists('settings')) {
    /**
     * Get all settings for a group.
     *
     * @param string $group The settings group
     * @return array
     */
    function settings(string $group): array
    {
        return Setting::getGroup($group);
    }
}
