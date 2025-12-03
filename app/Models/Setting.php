<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key', 'value', 'type', 'group',
    ];

    /**
     * Get a setting value by key with caching
     */
    public static function get(string $key, $default = null)
    {
        return Cache::remember("setting_{$key}", 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }

    /**
     * Set a setting value
     */
    public static function set(string $key, $value, string $type = 'string', string $group = null): void
    {
        static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group,
            ]
        );

        Cache::forget("setting_{$key}");
        Cache::forget('settings_by_group_' . $group);
    }

    /**
     * Get all settings in a group
     */
    public static function getByGroup(string $group): array
    {
        return Cache::remember("settings_by_group_{$group}", 3600, function () use ($group) {
            return static::where('group', $group)->pluck('value', 'key')->toArray();
        });
    }

    /**
     * Get all settings grouped by their group
     */
    public static function getAllGrouped(): array
    {
        return Cache::remember('settings_all_grouped', 3600, function () {
            $settings = static::all();
            $grouped = [];

            foreach ($settings as $setting) {
                $group = $setting->group ?? 'general';
                $grouped[$group][$setting->key] = $setting->value;
            }

            return $grouped;
        });
    }

    /**
     * Clear all settings cache
     */
    public static function clearCache(): void
    {
        Cache::flush();
    }
}
