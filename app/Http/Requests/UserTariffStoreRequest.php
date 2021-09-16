<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserTariffStoreRequest extends FormRequest
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
            'tariff_id' => ['required', 'integer', 'exists:tariffs,id'],
            'period' => ['required', 'integer'],
            'payment_amount' => ['required', 'integer'],
            'finished_at' => ['required'],
        ];
    }
}
