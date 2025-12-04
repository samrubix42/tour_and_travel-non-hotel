<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (! function_exists('setting')) {
    /**
     * Get a setting value by key with cache.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function setting(string $key, $default = null)
    {
        $cacheKey = 'setting:' . $key;

        $value = Cache::rememberForever($cacheKey, function () use ($key) {
            return Setting::where('key', $key)->value('value');
        });

        return $value === null ? $default : $value;
    }
}

if (! function_exists('settings')) {
    /**
     * Get all settings as associative array.
     *
     * @return array
     */
    function settings(): array
    {
        return Cache::rememberForever('settings:all', function () {
            return Setting::all()->pluck('value', 'key')->toArray();
        });
    }
}

if (! function_exists('set_setting')) {
    /**
     * Set a setting value and clear cache for that key.
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    function set_setting(string $key, $value): void
    {
        Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        Cache::forget('setting:' . $key);
        Cache::forget('settings:all');
    }
}

if (! function_exists('clear_settings_cache')) {
    function clear_settings_cache(): void
    {
        Cache::forget('settings:all');
    }
}
