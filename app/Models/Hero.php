<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'link', 'category_id'];
    protected $hidden = ['category_id'];

    public function image()
    {
        return $this->hasOne(Image::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function positions()
    {
        return $this->hasMany(HeroPosition::class);
    }

    public function strongOpponents()
    {
        return $this->hasMany(StrongOpponent::class);
    }

    public function weakOpponents()
    {
        return $this->hasMany(WeakOpponent::class);
    }
}
