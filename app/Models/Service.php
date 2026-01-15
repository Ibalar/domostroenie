<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'full_text',
        'parent_id',
        'sort_order',
        'image',
        'is_published',
        'meta_fields',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'meta_fields' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Родительская услуга
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'parent_id');
    }

    // Дочерние услуги
    public function children(): HasMany
    {
        return $this->hasMany(Service::class, 'parent_id')->orderBy('sort_order');
    }

    // Рекурсивное получение всех дочерних элементов
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    // Scope для опубликованных
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    // Scope для корневых элементов
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }
}
