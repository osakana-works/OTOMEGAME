<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'is_published',
        'created_by',
    ];

    public function scenes()
    {
        return $this->hasMany(Scene::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
