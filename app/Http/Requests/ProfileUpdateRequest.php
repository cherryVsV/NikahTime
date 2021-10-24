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
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:20'],
            'contactPhoneNumber' => ['required', 'string', 'max:25'],
            'birthDate' => ['required', 'date'],
            'country' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'education' => ['required'],
            'maritalStatus' => ['required'],
            'haveChildren' => ['boolean'],
            'badHabits' => ['required', 'array'],
            'badHabits.*' => ['string', 'required'],
            'interests' => ['required', 'array'],
            'interests.*' => ['string', 'required']
        ];
    }
}
