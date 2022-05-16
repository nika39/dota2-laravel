<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Rank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

// set_time_limit(0);

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $heroes = Hero::select('id', 'name', 'link', 'category_id')
            ->with(['image:id,hero_id,path', 'category:id,name', 'strongOpponents', 'weakOpponents']);

        if ($request->has('rank')) {
            $rank_id = Rank::where('title', $request->input('rank'))->firstOrFail()->id;

            $heroes->with(['positions' => function ($query) use ($rank_id) {
                $query->with(['position'])->where('rank_id', $rank_id);
            }]);
        } else {
            $heroes->with(['positions' => function ($query) {
                $query->with(['position', 'rank']);
            }]);
        }

        if ($request->has('cat')) {
            $validated = $request->validate([
                'cat' => 'integer|in:1,2,3',
            ]);

            $heroes->where('category_id', $validated['cat']);
        }

        $data = collect($heroes->orderBy('name')->get()->toArray())->map(function ($hero) use ($request) {
            $hero['strong_opponents'] = collect($hero['strong_opponents'])->map(fn ($opponent) => $opponent['strong_opponent_id']);
            $hero['weak_opponents'] = collect($hero['weak_opponents'])->map(fn ($opponent) => $opponent['weak_opponent_id']);
            if ($request->has('rank')) {
                $hero['positions'] = collect($hero['positions'])->map(fn ($position) => $position['position']['position']);
            }

            return $hero;
        });

        return $data;

        if ($request->has('rank') && $request->has('position')) {
            $validated = $request->validate([
                'rank' => 'string|exists:ranks,title',
                'position' => 'integer|exists:positions,position'
            ]);

            $data = collect($data)->filter(function ($hero) use ($validated) {
                return collect($hero['position'])->some(function ($item) use ($validated) {
                    return $item['rank']['title'] === $validated['rank'] && $item['position']['position'] === (int)$validated['position'];
                });
            });
        }

        // $collected_heroes = $collected_heroes->map(function ($hero) {
        //     if (!count($hero['position'])) return $hero;

        //     $hero['position'] = collect($hero['position'])->map(function ($position) {
        //         return [
        //             'rank' => $position['rank']['title'],
        //             'position' => $position['position']['position']
        //         ];
        //     });

        //     return $hero;
        // });

        // return $heroes;


        return $data;
        // return response()->json($heroes->orderBy('name')->get(), 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
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
            'name' => 'required|unique:heroes,name|max:255',
            'link' => 'required|url',
            'image_url' => 'required|url',
            'cat' => 'integer|in:1,2,3',
        ]);

        $hero = Hero::create([
            'name' => $validated['name'],
            'link' => $validated['link'],
            'category_id' => $validated['cat']
        ]);

        // $parsed_url = parse_url($hero->image_url);
        // $path = str_replace(substr($hero->image_url, strpos($hero->image_url, '.png') + 4), "", $parsed_url['path']);
        // $image_url = $parsed_url['scheme'] . "://" . $parsed_url['host'] . $path;
        $image_name = $hero->id . "_" . Str::slug($hero->name) . ".png";
        Storage::put('public/images/' . $image_name, file_get_contents($validated['image_url']));
        $hero->image()->create(['path' => 'public/images/' . $image_name]);


        return $hero;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $hero = Hero::select('id', 'name', 'link', 'category_id')
            ->with(['image:id,hero_id,path', 'category:id,name', 'strongOpponents', 'weakOpponents'])->where('id', $id);

        if ($request->has('rank')) {
            $rank_id = Rank::where('title', $request->input('rank'))->firstOrFail()->id;

            $hero->with(['positions' => function ($query) use ($rank_id) {
                $query->with(['position'])->where('rank_id', $rank_id);
            }]);
        } else {
            $hero->with(['positions' => function ($query) {
                $query->with(['position', 'rank']);
            }]);
        }

        $hero = $hero->firstOrFail()->toArray();

        $hero['strong_opponents'] = collect($hero['strong_opponents'])->map(fn ($opponent) => $opponent['strong_opponent_id']);
        $hero['weak_opponents'] = collect($hero['weak_opponents'])->map(fn ($opponent) => $opponent['weak_opponent_id']);
        if ($request->has('rank')) {
            $hero['positions'] = collect($hero['positions'])->map(fn ($position) => $position['position']['position']);
        }

        return $hero;
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
