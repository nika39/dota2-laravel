<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StrongOpponent extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['hero_id', 'strong_opponent_id'];
    // protected $with = ['opponent:id,name,image_url'];

    // protected $hidden = [
    //     'hero_id',
    // ];

    // public function opponent()
    // {
    //     return $this->belongsTo(Hero::class, 'opponent_hero_id');
    // }

    // public function reasons()
    // {
    //     return $this->morphMany(CounterReason::class, 'reasonable');
    // }
}
