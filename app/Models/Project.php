<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'order'
    ];

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class);
    }

    public function media()
    {
        return $this->hasMany(ProjectMedia::class);
    }
}
