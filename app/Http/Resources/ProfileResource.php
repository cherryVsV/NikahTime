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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'avatar' => $this->avatar,
            'name' => $this->name,
            'gender' => $this->gender,
            'birthdate' => $this->birthdate,
            'country' => $this->country,
            'town' => $this->town,
            'education_id' => $this->education_id,
            'place_of_study' => $this->place_of_study,
            'place_of_work' => $this->place_of_work,
            'post' => $this->post,
            'marital_status_id' => $this->marital_status_id,
            'children' => $this->children,
            'habit_id' => $this->habit_id,
            'about_me' => $this->about_me,
        ];
    }
}
