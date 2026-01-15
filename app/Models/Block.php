<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Block extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'title',
        'content',
        'image',
        'link',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Scope для активных блоков
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Полный URL изображения
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    // Полный URL ссылки
    public function getFullLinkAttribute(): ?string
    {
        if (!$this->link) {
            return null;
        }

        if (filter_var($this->link, FILTER_VALIDATE_URL)) {
            return $this->link;
        }

        return url($this->link);
    }
}
