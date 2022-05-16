<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $heroes = Hero::select('id', 'name', 'link', 'category_id')
        //     ->with(['image:id,hero_id,path', 'strongOpponents', 'category:id,name', 'positions' => function ($query) {
        //         $query->with(['position'])->where('rank_id', 4);
        //     }])->orderBy('name')->get()->toArray();

        // $heroes_collection = collect($heroes)->map(function ($hero) {
        //     $hero['strong_opponents'] = collect($hero['strong_opponents'])->map(fn ($counter) => $counter['strong_opponent_id']);
        //     $hero['positions'] = collect($hero['positions'])->map(fn ($position) => $position['position']['position']);

        //     return $hero;
        // });

        return view('welcome');
    }
}
