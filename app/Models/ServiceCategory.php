<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'parent_id',
        'sort_order',
        'is_published',
        'show_in_menu',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'show_in_menu' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'category_id');
    }

    public function menuServices(): HasMany
    {
        return $this->services()
            ->where('is_published', true)
            ->orderBy('sort_order');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('sort_order');
    }

    public function visibleChildren(): HasMany
    {
        return $this->children()
            ->where('is_published', true)
            ->where('show_in_menu', true);
    }

    public function allVisibleChildren(): HasMany
    {
        return $this->visibleChildren()->with(['allVisibleChildren', 'menuServices']);
    }
}
