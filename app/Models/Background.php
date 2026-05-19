<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Background extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image_path',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function scenes1()
    {
        return $this->hasMany(Scene::class, 'background_id1');
    }

    public function scenes2()
    {
        return $this->hasMany(Scene::class, 'background_id2');
    }    
}
