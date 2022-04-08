<?php

namespace App\Http\Controllers;

use App\Exceptions\ProjectExceptions\BaseError;
use App\Exceptions\ProjectExceptions\ValidationDataError;
use App\Http\Resources\ProfileResource;
use App\Models\Like;
use App\Models\Profile;
use App\Models\User;
use App\Models\UserBlock;
use Exception;
use Illuminate\Support\Facades\URL;

class FavouritesController extends Controller
{
    public function deleteFromUserFavourites($userId)
    {
        $auth_id = auth()->user()->getAuthIdentifier();
        if (!User::where('id', $userId)->exists() || !Like::where(['user_id' => $auth_id, 'favourite_user_id' => $userId])->exists()) {
            throw new ValidationDataError('ERR_FIND_USER_FAILED', 422, 'Selected user do not exists');
        }
        Like::where(['user_id' => $auth_id, 'favourite_user_id' => $userId])->delete();
        return $this->getUserFavourites();
    }

    public function addToUserFavourites($userId)
    {
        if (!User::where('id', $userId)->exists() || !is_null(User::where('id', $userId)->value('blocked_at'))) {
            throw new ValidationDataError('ERR_FIND_USER_FAILED', 422, 'Selected user do not exists or is blocked');
        }
        $auth_id = auth()->user()->getAuthIdentifier();
        if(UserBlock::where(['user_id'=> $userId, 'block_user_id'=>$auth_id])->exists() || UserBlock::where(['block_user_id'=> $userId, 'user_id'=>$auth_id])->exists()){
            throw new ValidationDataError('ERR_USER_BLOCKED', 422, 'Selected user is blocked or blocked auth user');
        }
        if (!Like::where(['user_id' => $auth_id, 'favourite_user_id' => $userId])->exists()) {
            Like::create([
                'user_id' => $auth_id,
                'favourite_user_id' => $userId
            ]);
            if(Like::where(['user_id' => $userId, 'favourite_user_id' => $auth_id])->exists() && is_null(User::where('id', $userId)->value('blocked_at'))){
                $user = Profile::find($userId);
                $avatar = null;
                if(!is_null($user->photos) && count(json_decode($user->photos))>0)
                {
                    $avatar = json_decode($user->photos)[0];
                    if(!str_starts_with($avatar, 'http')){
                        $avatar = URL::to('/') . '/storage/'.$avatar;
                    }
                }
                return response()->json([
                    'favouriteId'=> $userId,
                    'userAvatar'=> $avatar,
                    'userName'=> $user->first_name,
                    'isOnline'=>$user->isOnline()
                ], 202);
            }
            return response(null, 200);
        } else {
            throw new ValidationDataError('ERR_ADD_FAVOURITE_FAILED', 422, 'Selected favourite user already exists in favourites');
        }

    }

    public function getUserFavourites()
    {
        try {
            $auth_id = auth()->user()->getAuthIdentifier();
            $favouritesIds = Like::where('user_id', $auth_id)->pluck('favourite_user_id');
            $favouritesProfiles = Profile::whereIn('user_id', $favouritesIds)->get();
            $favourites = [];
            foreach ($favouritesProfiles as $favourite) {
                if (is_null(User::where('id', $favourite->user_id)->value('blocked_at'))){
                    $favourites[] = new ProfileResource($favourite);
                }
            }
            return response()->json($favourites, 200);

        } catch (Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'title' => 'ERR_GET_FAVOURITES_DATA_FAILED',
                'details' => $e->getMessage()],
                404);
        }

    }
}
