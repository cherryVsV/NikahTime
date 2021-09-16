<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserTariffResource extends JsonResource
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
            'tariff_id' => $this->tariff_id,
            'period' => $this->period,
            'payment_amount' => $this->payment_amount,
            'finished_at' => $this->finished_at,
        ];
    }
}
