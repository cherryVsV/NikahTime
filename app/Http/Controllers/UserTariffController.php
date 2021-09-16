<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserTariffStoreRequest;
use App\Http\Requests\UserTariffUpdateRequest;
use App\Http\Resources\UserTariffCollection;
use App\Http\Resources\UserTariffResource;
use App\Models\UserTariff;
use Illuminate\Http\Request;

class UserTariffController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\UserTariffCollection
     */
    public function index(Request $request)
    {
        $userTariffs = UserTariff::all();

        return new UserTariffCollection($userTariffs);
    }

    /**
     * @param \App\Http\Requests\UserTariffStoreRequest $request
     * @return \App\Http\Resources\UserTariffResource
     */
    public function store(UserTariffStoreRequest $request)
    {
        $userTariff = UserTariff::create($request->validated());

        return new UserTariffResource($userTariff);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserTariff $userTariff
     * @return \App\Http\Resources\UserTariffResource
     */
    public function show(Request $request, UserTariff $userTariff)
    {
        return new UserTariffResource($userTariff);
    }

    /**
     * @param \App\Http\Requests\UserTariffUpdateRequest $request
     * @param \App\Models\UserTariff $userTariff
     * @return \App\Http\Resources\UserTariffResource
     */
    public function update(UserTariffUpdateRequest $request, UserTariff $userTariff)
    {
        $userTariff->update($request->validated());

        return new UserTariffResource($userTariff);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserTariff $userTariff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, UserTariff $userTariff)
    {
        $userTariff->delete();

        return response()->noContent();
    }
}
