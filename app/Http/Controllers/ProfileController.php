<?php

namespace App\Http\Controllers;

use App\Exceptions\ProjectExceptions\ValidationDataError;
use App\Http\Requests\ProfileStoreRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\ProfileCollection;
use App\Http\Resources\ProfileResource;
use App\Models\Education;
use App\Models\Habit;
use App\Models\Interest;
use App\Models\MaritalStatus;
use App\Models\Profile;
use Database\Seeders\MaritalStatusSeeder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Nette\Schema\ValidationException;

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
            $profile = Profile::where('user_id', $user_id)->first();
            return response()->json([
                'User'=> new ProfileResource($profile)
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                    'title' => $e->getMessage(),
                    'details' => $e->getMessage()],
                404);
        }
    }

    /**
     * @param \App\Http\Requests\ProfileStoreRequest $request
     * @return \App\Http\Resources\ProfileResource
     */
    public function store(ProfileStoreRequest $request)
    {
        $profile = Profile::create($request->validated());

        return new ProfileResource($profile);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Profile $profile
     * @return \App\Http\Resources\ProfileResource
     */
    public function show(Request $request, Profile $profile)
    {
        return new ProfileResource($profile);
    }

    /**
     * @param \App\Http\Requests\ProfileUpdateRequest $request
     * @param \App\Models\Profile $profile
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUser(ProfileUpdateRequest $request)
    {
        $user_id = auth()->user()->getAuthIdentifier();
        $profile = Profile::where('user_id', $user_id)->first();
        $profile->first_name = $request->firstName;
        $profile->last_name = $request->lastName;
        $profile->gender = $request->gender;
        $profile->photos = $request->photos;
        $profile->birth_date = $request->birthDate;
        $profile->country = $request->country;
        $profile->city = $request->city;
        $profile->contact_phone_number = $request->contactPhoneNumber;
        if (!Education::where('title', $request->education)->exists()) {
            throw new ValidationDataError('ValidationException', 422, 'education do not exist in Education');
        }
        $education = Education::where('title', $request->education)->first();
        $profile->education_id = $education->id;
        if (!MaritalStatus::where('title', $request->maritalStatus)->exists()) {
            throw new ValidationDataError('ValidationException', 422, 'maritalStatus do not exist in MaritalStatus');
        }
        $status = MaritalStatus::where('title', $request->maritalStatus)->first();
        $profile->marital_status_id = $status->id;
        $profile->have_children = $request->haveChildren;
        DB::table('profile_habit')->where('profile_id', $profile->id)->delete();
        DB::table('profile_interest')->where('profile_id', $profile->id)->delete();
        foreach ($request->badHabits as $habit) {
            $badHabit = Habit::where('title', $habit)->first();
            $profile->habits()->save($badHabit);
        }
        foreach ($request->interests as $title) {
            if (Interest::where('title', $title)->exists()) {
                $interest = Interest::where('title', $title)->first();
                $profile->interests()->save($interest);

            } else {
                $interest = Interest::create(['title' => $title]);
                $profile->interests()->save($interest);
            }
        }
        $profile->place_of_study = $request->placeOfStudy;
        $profile->place_of_work = $request->placeOfWork;
        $profile->work_position = $request->workPosition;
        $patternUrl = '/(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w\.-]*)*\/?$/';
        $patternPhone = '/[(]*\d{3}[)]*\s*[.\-\s]*\d{3}[.\-\s]*\d{4}/';
        if (preg_match($patternUrl, $request->about) || preg_match($patternPhone, $request->about)) {
            throw new ValidationDataError('ValidationException', 422, 'Field about contains unresolved characters');
        }
        $profile->about = $request->about;
        $profile->save();
        return response()->json([], 200);


    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(Request $request, Profile $profile)
    {
        $profile->delete();

        return response()->noContent();
    }
}
