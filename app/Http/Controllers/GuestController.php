<?php

namespace App\Http\Controllers;

use App\Exceptions\ProjectExceptions\ValidationDataError;
use App\Http\Resources\ProfileResource;
use App\Models\Guest;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Exception;

class GuestController extends Controller
{
    public function addUserGuest($userId)
    {
        if(!User::where('id', $userId)->exists() || !is_null(User::where('id', $userId)->value('blocked_at'))){
            throw new ValidationDataError('ERR_FIND_USER_FAILED', 422, 'Selected user do not exists or is blocked');
        }
        $auth_id = auth()->user()->getAuthIdentifier();
        if(Guest::where(['user_id'=>$userId, 'guest_id'=>$auth_id])->exists()){
            Guest::where(['user_id'=>$userId, 'guest_id'=>$auth_id])->delete();
        }
        Guest::create([
            'user_id'=>$userId,
            'guest_id'=>$auth_id
        ]);
        return response(null, 200);

    }
    public function getGuestsUser()
    {
        try{
            $auth_id = auth()->user()->getAuthIdentifier();
            $guestsIds = Guest::where('user_id', $auth_id)->pluck('guest_id');
            $guestsProfiles = Profile::whereIn('user_id', $guestsIds)->get();
            $guests = [];
            foreach($guestsProfiles as $guest){
                if(is_null(User::where('id', $guest->user_id)->value('blocked_at'))) {
                    $date = Carbon::parse(Guest::where('guest_id', $guest->user_id)->first()->value('created_at'))->format('d-m-Y');
                    $guest->date = $date;
                    $guests[] = new ProfileResource($guest);
                }
            }
            return response()->json($guests, 200);

        }
        catch (Exception $e){
            return response()->json([
                'code' => $e->getCode(),
                'title' => 'ERR_GET_GUESTS_DATA_FAILED',
                'details' => $e->getMessage()],
                404);
        }
    }
}
