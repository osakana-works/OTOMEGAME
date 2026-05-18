<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];

    public function images()
    {
        return $this->hasMany(CharacterImage::class);
    }    
}
