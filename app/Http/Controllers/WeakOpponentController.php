<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\WeakOpponent;
use Illuminate\Http\Request;

class WeakOpponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validated = $request->validate([
            'hero' => 'required|exists:heroes,name',
            'opponent' => 'required|exists:heroes,name',
        ]);

        $hero = Hero::select('id')->where('name', $validated['hero'])->first();
        $opponent = Hero::select('id')->where('name', $validated['opponent'])->first();

        return WeakOpponent::where('hero_id', $hero->id)->where('weak_opponent_id', $opponent->id)->firstOrFail();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'hero' => 'required|exists:heroes,name',
            'opponent' => 'required|exists:heroes,name',
        ]);

        $hero = Hero::select('id')->where('name', $validated['hero'])->first();
        $opponent = Hero::select('id')->where('name', $validated['opponent'])->first();

        if (WeakOpponent::where('hero_id', $hero->id)->where('weak_opponent_id', $opponent->id)->exists()) {
            return response()->json([
                'message' => 'Similar WeakOpponent already exists!'
            ], 422);
        }

        return WeakOpponent::create([
            'hero_id' => $hero->id,
            'weak_opponent_id' => $opponent->id,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
