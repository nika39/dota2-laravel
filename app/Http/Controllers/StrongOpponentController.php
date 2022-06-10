<?php

namespace App\Http\Controllers;

use App\Models\StrongOpponent;
use App\Models\Hero;
use Illuminate\Http\Request;

class StrongOpponentController extends Controller
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

        $hero = Hero::select('id')
            ->where('name', $validated['hero'])
            ->first();
        $opponent = Hero::select('id')
            ->where('name', $validated['opponent'])
            ->first();

        return StrongOpponent::where('hero_id', $hero->id)
            ->where('strong_opponent_id', $opponent->id)
            ->firstOrFail();
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

        if ($validated['hero'] == $validated['opponent']) {
            return response()->json(
                [
                    'message' => 'The names of the heroes are the same!',
                ],
                422
            );
        }

        $hero = Hero::select('id')
            ->where('name', $validated['hero'])
            ->firstOrFail();
        $opponent = Hero::select('id')
            ->where('name', $validated['opponent'])
            ->firstOrFail();

        if (
            StrongOpponent::where('hero_id', $hero->id)
                ->where('strong_opponent_id', $opponent->id)
                ->exists()
        ) {
            return response()->json(
                [
                    'message' => 'Similar StrongOpponent already exists!',
                ],
                422
            );
        }

        return StrongOpponent::create([
            'hero_id' => $hero->id,
            'strong_opponent_id' => $opponent->id,
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
