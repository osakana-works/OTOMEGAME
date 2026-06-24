<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChoiceEffect extends Model
{
    use HasFactory;

    protected $fillable = [
        'choice_id',
        'character_id',
        'affection_delta',
        'flag_id',
        'flag_value',
    ];

    public function choice()
    {
        return $this->belongsTo(Choice::class);
    }

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function flag()
    {
        return $this->belongsTo(Flag::class);
    }
}
