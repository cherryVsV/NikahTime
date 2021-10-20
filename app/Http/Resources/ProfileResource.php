<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $maritalStatus = null;
        $education = null;
        $birthDate = null;
        if(!is_null($this->maritalStatus)){
            $maritalStatus = $this->maritalStatus->title;
        }
        if(!is_null($this->education)){
            $education = $this->education->title;
        }
        if(!is_null($this->birth_date)){
            $birthDate = Carbon::parse($this->birth_date)->format('d-m-Y');
        }
        return [
            'id'=>$this->user_id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'photos'=>$this->photos,
            'gender' => $this->gender,
            'birthDate' => $birthDate,
            'country' => $this->country,
            'city' => $this->city,
            'contactPhoneNumber'=>$this->contact_phone_number,
            'education' => $education,
            'placeOfStudy' => $this->place_of_study,
            'placeOfWork' => $this->place_of_work,
            'workPosition' => $this->work_position,
            'maritalStatus' => $maritalStatus,
            'haveChildren' => $this->have_children,
            'badHabits'=>$this->habits()->pluck('title'),
            'interests'=>$this->interests()->pluck('title'),
            'about' => $this->about,
            'date' => $this->when($this->date, $this->date),
        ];
    }
}
