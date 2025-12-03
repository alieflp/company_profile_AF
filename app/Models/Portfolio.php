<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'description', 'image', 'gallery', 'link', 'category', 'client', 'completed_at', 'tech_stack', 'is_published',
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_published' => 'boolean',
        'completed_at' => 'date',
    ];

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->image ? asset($this->image) : null;
    }
    
}
