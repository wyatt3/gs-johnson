<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectMedia extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectMediaFactory> */
    use HasFactory;

    protected $fillable = [
        'project_id',
        'order',
        'path'
    ];

    /**
     * Get the project that owns the media.
     *
     * @return BelongsTo<Project, $this>
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
