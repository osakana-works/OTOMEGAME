<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scene extends Model
{
    use HasFactory;
    protected $fillable = [
        'story_id',
        'order',
        'background_id1',
        'background_id2',
        'balloon_id',
        'text',
        'character_image1_id',
        'character_image2_id',
        'character_image3_id',
    ];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function background1()
    {
        return $this->belongsTo(Background::class, 'background_id1');
    }

    public function background2()
    {
        return $this->belongsTo(Background::class, 'background_id2');
    }

    public function balloon()
    {
        return $this->belongsTo(Balloon::class);
    }

    public function characterImage1()
    {
        return $this->belongsTo(CharacterImage::class, 'character_image1_id');
    }

    public function characterImage2()
    {
        return $this->belongsTo(CharacterImage::class, 'character_image2_id');
    }

    public function characterImage3()
    {
        return $this->belongsTo(CharacterImage::class, 'character_image3_id');
    }

    public function choices()
    {
        return $this->hasMany(Choice::class)->orderBy('sort_order');
    }
}
