<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;

    protected $fillable = [
        'scene_id',
        'label',
        'sort_order',
        'next_scene_id',
    ];

    public function scene()
    {
        return $this->belongsTo(Scene::class, 'scene_id');
    }

    public function nextScene()
    {
        return $this->belongsTo(Scene::class, 'next_scene_id');
    }

    public function effects()
    {
        return $this->hasMany(ChoiceEffect::class);
    }
}
