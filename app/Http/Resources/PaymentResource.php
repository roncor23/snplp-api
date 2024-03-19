<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'personal_id' => $this->personal_id,
            'date_paid' => $this->date_paid,
            'amount_paid' => $this->amount_paid,
            'confirmation_number' => $this->confirmation_number,
        ];
    }
}
