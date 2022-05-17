<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['hero_id', 'path'];

    protected $hidden = ['hero_id'];

    protected function path(): Attribute
    {
        return Attribute::make(get: fn($value) => Storage::url($value));
    }
}
