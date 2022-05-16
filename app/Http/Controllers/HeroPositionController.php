<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\HeroPosition;
use App\Models\Position;
use App\Models\Rank;
use Illuminate\Http\Request;

class HeroPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heroes = Hero::select('id', 'name')->get();
        $ranks = Rank::select('id', 'title')->get();
        $positions = Position::select('title', 'position')->get();

        return view('positions', [
            'heroes' => $heroes,
            'ranks' => $ranks,
            'positions' => $positions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'hero' => 'required|integer|exists:heroes,id',
            'ranks' => 'required|array',
            'ranks.*' => 'required|integer|exists:ranks,id',
            'positions' => 'required|array',
            'positions.*' => 'required|integer|exists:positions,position',
        ]);

        $positions = [];
        foreach ($validated['ranks'] as $rank_id) {
            foreach ($validated['positions'] as $position) {
                $positions[] = [
                    'hero_id' => (int)$validated['hero'],
                    'rank_id' => (int)$rank_id,
                    'position_id' => (int)$position
                ];
            }
        }

        // return $positions;



        HeroPosition::insert($positions);

        return back()->with([
            'status' => 'success!',
            'values' => [
                'positions' => $validated['positions'],
                'ranks' => $validated['ranks'],
                'hero_id' => (int)$validated['hero']
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HeroPosition  $heroPosition
     * @return \Illuminate\Http\Response
     */
    public function show(HeroPosition $heroPosition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HeroPosition  $heroPosition
     * @return \Illuminate\Http\Response
     */
    public function edit(HeroPosition $heroPosition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HeroPosition  $heroPosition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HeroPosition $heroPosition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HeroPosition  $heroPosition
     * @return \Illuminate\Http\Response
     */
    public function destroy(HeroPosition $heroPosition)
    {
        //
    }
}
