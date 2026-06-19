<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'order'
    ];

    /**
     * Get the category that owns the project.
     *
     * @return BelongsTo<ProjectCategory, $this>
     */
    public function projectCategory(): BelongsTo
    {
        return $this->belongsTo(ProjectCategory::class, 'category_id');
    }

    /**
     * Get all of the project's media.
     *
     * @return HasMany<ProjectMedia, $this>
     */
    public function media(): HasMany
    {
        return $this->hasMany(ProjectMedia::class)->orderBy('order');
    }
}
