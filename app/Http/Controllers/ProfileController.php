<?php

namespace App\Http\Controllers;

use App\Exceptions\ProjectExceptions\ValidationDataError;
use App\Http\Requests\ProfileStoreRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Education;
use App\Models\Habit;
use App\Models\Interest;
use App\Models\MaritalStatus;
use App\Models\Profile;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser()
    {
        try {
            $user_id = auth()->user()->getAuthIdentifier();
            if(Profile::where('user_id', $user_id)->exists()) {
                $profile = Profile::where('user_id', $user_id)->first();
            }else{
                $profile = Profile::create([
                    'user_id'=>$user_id
                ]);
            }
            return response()->json([
                new ProfileResource($profile)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'title' => 'ERR_GET_USER_DATA_FAILED',
                'details' => $e->getMessage()],
                404);
        }
    }

    public function getUserById($userId)
    {
        if(!User::where('id', $userId)->exists() || !is_null(User::where('id', $userId)->value('blocked_at'))){
            throw new ValidationDataError('ERR_FIND_USER_FAILED', 422, 'Selected user do not exists or is blocked');
        }
        try{
            $profile = Profile::where('user_id', $userId)->first();
            return response()->json([
                new ProfileResource($profile)
            ], 200);

        }catch (Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'title' => 'ERR_GET_USER_DATA_FAILED',
                'details' => $e->getMessage()],
                404);
        }

    }

    /**
     * @param \App\Http\Requests\ProfileUpdateRequest $request
     * @param \App\Models\Profile $profile
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function updateUser(ProfileUpdateRequest $request)
    {
        $user_id = auth()->user()->getAuthIdentifier();
        $profile = Profile::where('user_id', $user_id)->first();
        $profile->first_name = $request->firstName;
        $profile->last_name = $request->lastName;
        $profile->gender = $request->gender;
        if(!is_null($request->photos)) {
            if (count($request->photos) > 10) {
                throw new ValidationDataError('ERR_VALIDATION_FAILED', 422, 'The photos field length should be no more than 10');
            }
        }
        $profile->photos = $request->photos;
        $profile->birth_date = $request->birthDate;
        $profile->country = $request->country;
        $profile->city = $request->city;
        $profile->contact_phone_number = $request->contactPhoneNumber;
        if(!is_null($request->education)) {
            if (!Education::where('title', $request->education)->exists()) {
                throw new ValidationDataError('ERR_VALIDATION_FAILED', 422, 'The education field do not exist in Education');
            }
            $education = Education::where('title', $request->education)->first();
            $profile->education_id = $education->id;
        }else{
            $profile->education_id = null;
        }
        if(!is_null($request->maritalStatus)) {
            if (!MaritalStatus::where('title', $request->maritalStatus)->exists()) {
                throw new ValidationDataError('ERR_VALIDATION_FAILED', 422, 'The maritalStatus field do not exist in MaritalStatus');
            }
            $status = MaritalStatus::where('title', $request->maritalStatus)->first();
            $profile->marital_status_id = $status->id;
        }else{
            $profile->marital_status_id = null;
        }
        $profile->have_children = $request->haveChildren;
        $profile->nationality = $request->nationality;
        DB::table('profile_habit')->where('profile_id', $profile->id)->delete();
        DB::table('profile_interest')->where('profile_id', $profile->id)->delete();
        if(!is_null($request->badHabits)) {
            foreach ($request->badHabits as $habit) {
                if (!is_null($habit)) {
                    $badHabit = Habit::where('title', $habit)->first();
                    $profile->habits()->save($badHabit);
                }
            }
        }
        if(!is_null($request->interests)) {
            foreach ($request->interests as $title) {
                if (!is_null($title)) {
                    if (Interest::where('title', $title)->exists()) {
                        $interest = Interest::where('title', $title)->first();
                        $profile->interests()->save($interest);

                    } else {
                        $interest = Interest::create(['title' => $title]);
                        $profile->interests()->save($interest);
                    }
                }
            }
        }
        $profile->place_of_study = $request->placeOfStudy;
        $profile->place_of_work = $request->placeOfWork;
        $profile->work_position = $request->workPosition;
        $patternUrl = '#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i';
        $patternPhone = '/[(]*\d{3}[)]*\s*[.\-\s]*\d{3}[.\-\s]*\d{4}/';
        if (preg_match($patternUrl, $request->about) || preg_match($patternPhone, $request->about)) {
            throw new ValidationDataError('ERR_VALIDATION_FAILED', 422, 'Field about contains unresolved characters');
        }
        $profile->about = $request->about;
        $profile->save();
        return response(null, 200);


    }

}
