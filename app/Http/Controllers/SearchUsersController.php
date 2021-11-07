<?php

namespace App\Http\Controllers;

use App\Exceptions\ProjectExceptions\ValidationDataError;
use App\Http\Resources\ProfileResource;
use App\Models\Education;
use App\Models\Habit;
use App\Models\MaritalStatus;
use App\Models\Profile;
use App\Models\SeenUser;
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
            })->where('id', '<>', $profile->id)->limit(20)->pluck('id');
            $users = Profile::whereIn('id', $selectionIds)->where('gender', '!=', $profile->gender)->get();
            $seenUsers = SeenUser::where('user_id', $profile->user_id)->pluck('seen_user_id');
            $selection = [];
            foreach ($users as $user) {
                if (count($seenUsers) > 0) {
                    if (!$seenUsers->contains($user->user_id)) {
                        $selection[] = new ProfileResource($user);
                    }
                }else {
                    $selection[] = new ProfileResource($user);
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
       $this->validate($request, [
           'seenUsersId'=>['required', 'array'],
           'seenUsersId.*' => ['integer', 'required', 'exists:users,id']
       ]);
        $user_id = auth()->user()->getAuthIdentifier();
        $seenUsers = SeenUser::where('user_id', $user_id)->pluck('seen_user_id');
        foreach ($request->seenUsersId as $seenUser){
            if (count($seenUsers) > 0) {
                if (!$seenUsers->contains($seenUser)) {
                    SeenUser::create([
                        'user_id' => $user_id,
                        'seen_user_id' => $seenUser
                    ]);
                }
            }
            else{
            SeenUser::create([
                'user_id' => $user_id,
                'seen_user_id' => $seenUser
            ]);}
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
            $userProfile = Profile::where('user_id', $user_id)->first();
            $seenUsers = SeenUser::where('user_id', $user_id)->pluck('seen_user_id');
            $seenProfiles = Profile::whereIn('user_id', $seenUsers)->get();
            $filters = [];
            if ($request->filterType == 'simpleFilter') {
                foreach ($seenProfiles as $profile) {
                    $age = Carbon::parse($profile->birth_date)->diffInYears();
                    if($request->isOnline) {
                        if ($age >= $request->minAge && $age <= $request->maxAge && $profile->gender != $userProfile->gender && $profile->isOnline()) {
                            $filters[] = new ProfileResource($profile);
                        }
                    }else{
                        if ($age >= $request->minAge && $age <= $request->maxAge && $profile->gender != $userProfile->gender) {
                            $filters[] = new ProfileResource($profile);
                        }
                    }
                }
            }
            if ($request->filterType == 'complicatedFilter') {
                foreach ($seenProfiles as $profile) {
                    $age = Carbon::parse($profile->birth_date)->diffInYears();
                    $education = null;
                    if(!is_null($request->education)) {
                        $education = Education::where('title', $request->education)->value('id');
                    }
                    $status = null;
                    if(!is_null($request->maritalStatus)) {
                        $status = MaritalStatus::where('title', $request->maritalStatus)->value('id');
                    }
                    if ($age >= $request->minAge && $age <= $request->maxAge && $profile->gender != $userProfile->gender
                        &&( is_null($request->city) || $profile->city == $request->city) && (is_null($request->country) || $profile->country == $request->country)
                        && (is_null($request->haveChildren) || $profile->have_children == $request->haveChildren)
                        && (is_null($education) || $profile->education_id == $education) && (is_null($status) || $profile->marital_status_id == $status)) {
                        if ($request->haveBadHabits) {
                            $badHabits = Habit::whereIn('title', $request->badHabits)->pluck('id');
                            if (collect($badHabits)->diff(collect($profile->habits->pluck('id')))->count() == 0) {
                                if($request->isOnline) {
                                    if($profile->isOnline()) {
                                        $filters[] = new ProfileResource($profile);
                                    }
                                }else{
                                    $filters[] = new ProfileResource($profile);
                                }
                            }
                        } else {
                            if ($profile->habits->count() == 0) {
                                if($request->isOnline) {
                                    if($profile->isOnline()) {
                                        $filters[] = new ProfileResource($profile);
                                    }
                                }else{
                                    $filters[] = new ProfileResource($profile);
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
