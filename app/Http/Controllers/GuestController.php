<?php

namespace App\Http\Controllers;

use App\Exceptions\ProjectExceptions\ValidationDataError;
use App\Http\Resources\ProfileResource;
use App\Models\Guest;
use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function addUserGuest($userId)
    {
        if(!User::where('id', $userId)->exists()){
            throw new ValidationDataError('ERR_FIND_USER_FAILED', 401, 'Selected user do not exists');
        }
        $auth_id = auth()->user()->getAuthIdentifier();
        if(Guest::where(['user_id'=>$auth_id, 'guest_id'=>$userId])->exists()){
            Guest::where(['user_id'=>$auth_id, 'guest_id'=>$userId])->delete();
        }
        Guest::create([
            'user_id'=>$auth_id,
            'guest_id'=>$userId
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
                $date = Carbon::parse(Guest::where('guest_id', $guest->user_id)->first()->value('created_at'))->format('d-m-Y');
                $guest->date = $date;
                $guests[] = new ProfileResource($guest);
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
