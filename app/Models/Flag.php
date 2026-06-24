<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    use HasFactory;

    protected $fillable = [
        'story_id',
        'code',
        'description',
    ];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function choiceEffects()
    {
        return $this->hasMany(ChoiceEffect::class);
    }

    public function userFlags()
    {
        return $this->hasMany(UserFlag::class);
    }
}
