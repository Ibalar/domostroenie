<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'image_path',
        'sort_order',
    ];

    // Проект изображения
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    // Полный URL изображения
    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }
}
