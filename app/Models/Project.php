<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'category_id',
        'price_from',
        'price_to',
        'area',
        'floors',
        'bedrooms',
        'bathrooms',
        'has_garage',
        'roof_type',
        'style',
        'main_image',
        'external_id',
        'is_featured',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'price_from' => 'decimal:2',
        'price_to' => 'decimal:2',
        'area' => 'decimal:2',
        'has_garage' => 'boolean',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Категория проекта
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }

    // Изображения проекта
    public function images(): HasMany
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }

    // Основное изображение (отношение)
    public function mainImage()
    {
        return $this->hasOne(ProjectImage::class)->where('sort_order', 0)->orWhereNull('sort_order');
    }

    // Scope для опубликованных
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Scope для избранных
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope для домов
    public function scopeHouses($query)
    {
        return $query->whereHas('category', function ($q) {
            $q->where('type', 'house');
        });
    }

    // Scope для бань
    public function scopeSaunas($query)
    {
        return $query->whereHas('category', function ($q) {
            $q->where('type', 'sauna');
        });
    }

    // Форматированная цена
    public function getFormattedPriceAttribute(): string
    {
        if ($this->price_from && $this->price_to) {
            return number_format($this->price_from, 0, '.', ' ') . ' - ' . number_format($this->price_to, 0, '.', ' ') . ' ₽';
        } elseif ($this->price_from) {
            return 'от ' . number_format($this->price_from, 0, '.', ' ') . ' ₽';
        } else {
            return 'Цена по запросу';
        }
    }
}
