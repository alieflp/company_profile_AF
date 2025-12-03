<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'content',
        'last_updated_at',
    ];

    protected $casts = [
        'last_updated_at' => 'datetime',
    ];

    /**
     * Get legal page by type
     */
    public static function getByType(string $type): ?self
    {
        return self::where('type', $type)->first();
    }
}
