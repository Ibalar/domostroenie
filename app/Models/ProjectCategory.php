<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'sort_order',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Проекты в категории
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'category_id');
    }

    // Scope для домов
    public function scopeHouses($query)
    {
        return $query->where('type', 'house');
    }

    // Scope для бань
    public function scopeSaunas($query)
    {
        return $query->where('type', 'sauna');
    }
}
