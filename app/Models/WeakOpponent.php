<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeakOpponent extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['hero_id', 'weak_opponent_id'];
    // protected $with = ['opponent:id,name'];
    // protected $hidden = [
    //     'hero_id',
    // ];

    public function opponent()
    {
        return $this->belongsTo(Hero::class, 'weak_opponent_id');
    }
}
