<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'order'
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'category_id', 'id')->orderBy('order');
    }
}
