<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'description', 'icon', 'icon_type', 'icon_color', 'image', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Accessors to match blade expectations
    public function getNameAttribute(): ?string
    {
        return $this->attributes['title'] ?? null;
    }

    public function getShortDescriptionAttribute(): ?string
    {
        return $this->attributes['excerpt'] ?? null;
    }

    public function getActiveAttribute(): bool
    {
        return (bool) ($this->attributes['is_active'] ?? false);
    }
}
