<?php

namespace App\Http\Controllers;

use App\Exceptions\ProjectExceptions\ValidationDataError;
use App\Http\Resources\UserTariffResource;
use App\Models\Tariff;
use App\Models\UserTariff;
use Carbon\Carbon;

class UserTariffController extends Controller
{

    public function setUserTariff($tariffId)
    {
        if (!Tariff::where('id', $tariffId)->exists()) {
            throw new ValidationDataError('ERR_VALIDATION_FAILED', 422, 'Selected tariff does not exist!');
        }
        $user_id = auth()->user()->getAuthIdentifier();
        $tariff = Tariff::find($tariffId);
        if (UserTariff::where('user_id', $user_id)->whereDate('finished_at', '>', Carbon::now())->exists()) {
            UserTariff::where('user_id', $user_id)->whereDate('finished_at', '>', Carbon::now())->delete();
        }
        UserTariff::create([
            'user_id' => $user_id,
            'tariff_id' => $tariffId,
            'payment_amount' => $tariff->price,
            'finished_at' => Carbon::now()->addDays($tariff->period)
        ]);
        return response(null, 200);

    }

    public function getTariffs()
    {
        if (Tariff::all()->count() < 1) {
            throw new ValidationDataError('ERR_VALIDATION_FAILED', 422, 'Tariffs do not exist!');
        }
        $tariffs = Tariff::get();
        $data = [];
        foreach ($tariffs as $tariff) {
            $data[] = new UserTariffResource($tariff);
        }
        return response()->json($data, 200);
    }

    public function getUserTariff()
    {
        $user_id = auth()->user()->getAuthIdentifier();
        if (UserTariff::where('user_id', $user_id)->whereDate('finished_at', '>', Carbon::now())->exists()) {
            $user_tariff = UserTariff::where('user_id', $user_id)->whereDate('finished_at', '>', Carbon::now())->first();
            $tariff_id = $user_tariff->tariff_id;
            $tariff = Tariff::find($tariff_id);
            return response()->json([
                new UserTariffResource($tariff)
            ]);
        } else {
            throw new ValidationDataError('ERR_VALIDATION_FAILED', 422, 'The authorized user does not have paid tariffs.');
        }
    }
}
