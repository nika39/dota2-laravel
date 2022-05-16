<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroPosition extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['position_id', 'hero_id', 'rank_id'];
    protected $hidden = ['position_id', 'hero_id', 'rank_id'];

    public function rank()
    {
        return $this->belongsTo(Rank::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class, ownerKey: 'position');
    }
}
