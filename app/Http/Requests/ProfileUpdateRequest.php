<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'avatar' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:20'],
            'birthdate' => ['required', 'date'],
            'country' => ['required', 'string', 'max:255'],
            'town' => ['required', 'string', 'max:255'],
            'education_id' => ['required', 'integer', 'exists:education,id'],
            'place_of_study' => ['required', 'string', 'max:255'],
            'place_of_work' => ['required', 'string', 'max:255'],
            'post' => ['required', 'string', 'max:255'],
            'marital_status_id' => ['required', 'integer', 'exists:marital_statuses,id'],
            'children' => ['required'],
            'habit_id' => ['required', 'integer', 'exists:habits,id'],
            'about_me' => ['required', 'string'],
        ];
    }
}
