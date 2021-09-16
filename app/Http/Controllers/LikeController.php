<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeStoreRequest;
use App\Http\Requests\LikeUpdateRequest;
use App\Http\Resources\LikeCollection;
use App\Http\Resources\LikeResource;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\LikeCollection
     */
    public function index(Request $request)
    {
        $likes = Like::all();

        return new LikeCollection($likes);
    }

    /**
     * @param \App\Http\Requests\LikeStoreRequest $request
     * @return \App\Http\Resources\LikeResource
     */
    public function store(LikeStoreRequest $request)
    {
        $like = Like::create($request->validated());

        return new LikeResource($like);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Like $like
     * @return \App\Http\Resources\LikeResource
     */
    public function show(Request $request, Like $like)
    {
        return new LikeResource($like);
    }

    /**
     * @param \App\Http\Requests\LikeUpdateRequest $request
     * @param \App\Models\Like $like
     * @return \App\Http\Resources\LikeResource
     */
    public function update(LikeUpdateRequest $request, Like $like)
    {
        $like->update($request->validated());

        return new LikeResource($like);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Like $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Like $like)
    {
        $like->delete();

        return response()->noContent();
    }
}
