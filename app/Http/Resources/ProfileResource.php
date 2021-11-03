<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

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
        $images = [];
        if(!is_null($this->maritalStatus)){
            $maritalStatus = $this->maritalStatus->title;
        }
        if(!is_null($this->education)){
            $education = $this->education->title;
        }
        if(!is_null($this->birth_date)){
            $birthDate = Carbon::parse($this->birth_date)->format('d.m.Y');
        }
        if(!is_null($this->photos)){
            foreach (json_decode($this->photos) as $photo){
                if(!str_starts_with($photo, URL::to('/') . '/storage')){
                    $photo = URL::to('/') . '/storage/'.$photo;
                }
                $images[] = $photo;
            }
        }

        return [
            'id'=>$this->user_id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'photos'=>$images,
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
            'isOnline'=>$this->isOnline()
        ];
    }
}
