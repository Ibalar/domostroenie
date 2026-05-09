<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HeroSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'background_image',
        'main_title',
        'subtitles',
        'button_primary_text',
        'button_primary_url',
        'button_secondary_text',
        'button_secondary_url',
        'is_active',
    ];

    protected $casts = [
        'subtitles' => 'array',
        'is_active' => 'boolean',
    ];

    public static function getActive(): ?self
    {
        return static::where('is_active', true)->latest()->first();
    }
}
