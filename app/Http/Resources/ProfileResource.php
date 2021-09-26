<?php

namespace App\Http\Resources;

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
        return [
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'photos'=>$this->photos,
            'gender' => $this->gender,
            'birthDate' => $this->birth_date,
            'country' => $this->country,
            'city' => $this->city,
            'contactPhoneNumber'=>$this->contact_phone_number,
            'education' => $this->education->title,
            'placeOfStudy' => $this->place_of_study,
            'placeOfWork' => $this->place_of_work,
            'workPosition' => $this->work_position,
            'maritalStatus' => $this->maritalStatus->title,
            'haveChildren' => $this->have_children,
            'badHabits'=>$this->habits(),
            'interests'=>$this->interests(),
            'about' => $this->about,
        ];
    }
}
