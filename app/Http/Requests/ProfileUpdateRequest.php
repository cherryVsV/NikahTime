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
            'gender' => ['nullable', 'string', 'max:20'],
            'contactPhoneNumber' => ['nullable', 'string', 'max:25'],
            'birthDate' => ['required', 'date'],
            'country' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'haveChildren' => ['boolean'],
            'badHabits' => ['nullable', 'array'],
            'interests' => ['nullable', 'array'],
            'nationality' => ['nullable', 'string', 'max:255']
        ];
    }
}
