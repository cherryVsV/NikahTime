<?php

namespace App\Http\Controllers;

use App\Exceptions\ProjectExceptions\ValidationDataError;
use App\Http\Resources\ProfileResource;
use App\Models\Education;
use App\Models\Habit;
use App\Models\MaritalStatus;
use App\Models\Profile;
use App\Models\SeenUser;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class SearchUsersController extends Controller
{
    public function getSelectionUsers()
    {
        try {
            $user_id = auth()->user()->getAuthIdentifier();
            $profile = Profile::where('user_id', $user_id)->first();
            $selectionIds = Profile::whereHas('interests', function ($query) use ($profile) {
                $query->whereIn('interest_id', $profile->interests->pluck('id'));
            })->where('user_id', '!=', $user_id)->pluck('id');
            $users = Profile::whereIn('id', $selectionIds)->get();
            $seenUsers = SeenUser::where('user_id', $profile->user_id)->pluck('seen_user_id');
            $selection = [];
            foreach ($users as $user) {
                    if(count($selection)<20) {
                        $user['isProfileParametersMatched'] = true;
                    if (count($seenUsers) > 0) {
                        if (!$seenUsers->contains($user->user_id)) {
                            if(is_null(User::where('id', $user->user_id)->value('blocked_at'))) {
                                $selection[] = new ProfileResource($user);
                            }
                        }
                    } else {
                        if(is_null(User::where('id', $user->user_id)->value('blocked_at'))) {
                            $selection[] = new ProfileResource($user);
                        }
                    }
                }
            }
            if(count($selection)<20){
                $profiles = Profile::where('user_id', '!=', $user_id)->get();
                foreach($profiles as $userProfile){
                    if(count($selection)<20) {
                        $userProfile['isProfileParametersMatched'] = false;
                        if (count($seenUsers) > 0) {
                            if (!$seenUsers->contains($userProfile->user_id)) {
                                if(is_null(User::where('id', $userProfile->user_id)->value('blocked_at'))) {
                                    $selection[] = new ProfileResource($userProfile);
                                }
                            }
                        } else {
                            if(is_null(User::where('id', $userProfile->user_id)->value('blocked_at'))) {
                                $selection[] = new ProfileResource($userProfile);
                            }
                        }
                    }
                }
            }
            return response()->json($selection, 200);
        } catch (Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'title' => 'ERR_GET_SELECTION_USER_DATA_FAILED',
                'details' => $e->getMessage()],
                404);
        }
    }

    public function saveSeenUsers(Request $request)
    {
        $user_id = auth()->user()->getAuthIdentifier();
        $seenUsers = SeenUser::where('user_id', $user_id)->pluck('seen_user_id');
        $data = json_decode($request->getContent());
        foreach ($data as $seenUser) {
            if (count($seenUsers) > 0) {
                if (!$seenUsers->contains($seenUser->userId) && User::where('id', $seenUser->userId)->exists() && $seenUser->userId !=$user_id) {
                    SeenUser::create([
                        'user_id' => $user_id,
                        'seen_user_id' => $seenUser->userId,
                        'is_matched' => $seenUser->isProfileParametersMatched
                    ]);
                } else {
                    throw new ValidationDataError('ERR_ADD_SEEN_USER', 422, 'Selected user can not be add as seen');
                }
            } else {
                if (User::where('id', $seenUser->userId)->exists()) {
                    SeenUser::create([
                        'user_id' => $user_id,
                        'seen_user_id' => $seenUser->userId,
                        'is_matched' => $seenUser->isProfileParametersMatched
                    ]);
                } else {
                    throw new ValidationDataError('ERR_USER_NOT_FOUND', 422, 'Selected user do not exists');
                }
            }
        }
        return response(null, 200);

    }

    public function searchUsers(Request $request)
    {
        $this->validate($request,[
            'filterType'=>['required', 'string'],
            'minAge'=>['required', 'integer'],
            'maxAge'=>['required', 'integer'],
            'isOnline'=>['required', 'boolean']
        ]);
        try {
            $user_id = auth()->user()->getAuthIdentifier();
            $seenUsers = SeenUser::where('user_id', $user_id)->pluck('seen_user_id');
            $seenProfiles = Profile::whereIn('user_id', $seenUsers)->get();
            $filters = [];
            if ($request->filterType == 'simpleFilter') {
                foreach ($seenProfiles as $profile) {
                    $profile['isProfileParametersMatched'] = (bool)SeenUser::where(['user_id' => $user_id, 'seen_user_id' => $profile->user_id])->value('is_matched');
                    $age = Carbon::parse($profile->birth_date)->diffInYears();
                    if($request->isOnline) {
                        if ($age >= $request->minAge && $age <= $request->maxAge && $profile->isOnline()) {
                            if(is_null(User::where('id', $profile->user_id)->value('blocked_at'))) {
                                $filters[] = new ProfileResource($profile);
                            }
                        }
                    }else{
                        if ($age >= $request->minAge && $age <= $request->maxAge) {
                            if(is_null(User::where('id', $profile->user_id)->value('blocked_at'))) {
                                $filters[] = new ProfileResource($profile);
                            }
                        }
                    }
                }
            }
            if ($request->filterType == 'complicatedFilter') {
                foreach ($seenProfiles as $profile) {
                    $profile['isProfileParametersMatched'] = (bool)SeenUser::where(['user_id' => $user_id, 'seen_user_id' => $profile->user_id])->value('is_matched');
                    $age = Carbon::parse($profile->birth_date)->diffInYears();
                    $education = null;
                    if($request->education) {
                        $education = Education::where('title', $request->education)->value('id');
                    }
                    $status = null;
                    if($request->maritalStatus) {
                        $status = MaritalStatus::where('title', $request->maritalStatus)->value('id');
                    }
                    if ($age >= $request->minAge && $age <= $request->maxAge
                        &&(!$request->has('city') || trim($profile->city) == trim($request->city)) && (!$request->has('country') || $profile->country == $request->country)
                        && (!$request->has('haveChildren') || $profile->have_children == $request->haveChildren)
                        && (is_null($education) || $profile->education_id == $education) && (is_null($status) || $profile->marital_status_id == $status)) {
                        if ($request->haveBadHabits) {
                            logger('zzz');
                            $badHabits = Habit::whereIn('title', $request->badHabits)->pluck('id');
                            if (collect($badHabits)->diff(collect($profile->habits->pluck('id')))->count() == 0) {
                                if($request->isOnline) {
                                    if($profile->isOnline()) {
                                        if(is_null(User::where('id', $profile->user_id)->value('blocked_at'))) {
                                            $filters[] = new ProfileResource($profile);
                                            logger('wwww');
                                        }
                                    }
                                }else{
                                    if(is_null(User::where('id', $profile->user_id)->value('blocked_at'))) {
                                        $filters[] = new ProfileResource($profile);
                                        logger('rrr');
                                    }
                                }
                            }
                        } else {
                            logger('eeeee');
                            if ($profile->habits->count() == 0) {
                                if($request->isOnline) {
                                    if($profile->isOnline()) {
                                        if(is_null(User::where('id', $profile->user_id)->value('blocked_at'))) {
                                        $filters[] = new ProfileResource($profile);
                                            logger('nnnn');
                                        }
                                    }
                                }else{
                                    if(is_null(User::where('id', $profile->user_id)->value('blocked_at'))) {
                                        $filters[] = new ProfileResource($profile);
                                        logger('kkkk');
                                    }
                                }
                            }
                        }
                    }
                }
            }
            return response()->json($filters, 200);
        }
        catch (Exception $e){
            return response()->json([
                'code' => $e->getCode(),
                'title' => 'ERR_GET_SELECTION_USER_DATA_FAILED',
                'details' => $e->getMessage()],
                422);
        }
    }
}
