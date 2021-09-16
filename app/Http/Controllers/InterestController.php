<?php

namespace App\Http\Controllers;

use App\Http\Requests\InterestStoreRequest;
use App\Http\Requests\InterestUpdateRequest;
use App\Http\Resources\InterestCollection;
use App\Http\Resources\InterestResource;
use App\Models\Interest;
use Illuminate\Http\Request;

class InterestController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\InterestCollection
     */
    public function index(Request $request)
    {
        $interests = Interest::all();

        return new InterestCollection($interests);
    }

    /**
     * @param \App\Http\Requests\InterestStoreRequest $request
     * @return \App\Http\Resources\InterestResource
     */
    public function store(InterestStoreRequest $request)
    {
        $interest = Interest::create($request->validated());

        return new InterestResource($interest);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Interest $interest
     * @return \App\Http\Resources\InterestResource
     */
    public function show(Request $request, Interest $interest)
    {
        return new InterestResource($interest);
    }

    /**
     * @param \App\Http\Requests\InterestUpdateRequest $request
     * @param \App\Models\Interest $interest
     * @return \App\Http\Resources\InterestResource
     */
    public function update(InterestUpdateRequest $request, Interest $interest)
    {
        $interest->update($request->validated());

        return new InterestResource($interest);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Interest $interest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Interest $interest)
    {
        $interest->delete();

        return response()->noContent();
    }
}
