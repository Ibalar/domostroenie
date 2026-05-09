<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Portfolio extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'project_id',
        'main_image',
        'gallery',
        'floors',
        'area',
        'implementation_period',
        'cost_text',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'area' => 'decimal:2',
        'floors' => 'integer',
        'is_published' => 'boolean',
        'gallery' => 'array',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(PortfolioImage::class)->orderBy('sort_order');
    }

    public function sections(): HasMany
    {
        return $this->hasMany(PortfolioSection::class)->orderBy('sort_order');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}