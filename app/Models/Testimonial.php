<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'position', 'company', 'message', 'avatar', 'rating', 'is_approved',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_approved' => 'boolean',
    ];

    // Accessors to align with blades
    public function getContentAttribute(): ?string
    {
        return $this->attributes['message'] ?? null;
    }

    public function getApprovedAttribute(): bool
    {
        return (bool) ($this->attributes['is_approved'] ?? false);
    }
}
