<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balloon extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image_path', 'character_id'];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function scenes()
    {
        return $this->hasMany(Scene::class);
    }    
}
