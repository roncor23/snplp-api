<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonalResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'last_name' => $this->last_name,
            'maiden_name' => $this->maiden_name,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'name_ext' => $this->name_ext,
            'course' => $this->course,
            'month_year_graduated' => $this->month_year_graduated,
            'sex' => $this->sex,
            'comaker' => $this->comaker,
            'hei' => $this->hei,
            'contact_number' => $this->contact_number,
            'address' => $this->address,
            'email' => $this->email,
            // Include other attributes you want to expose
            'employment_info' => new EmploymentResource($this->whenLoaded('employmentInfo')),
            'status_info' => new StatusResource($this->whenLoaded('statusInfo')),
            'disbursement_info' => new DisbursementResource($this->whenLoaded('disbursementInfo')),
            'repayment_info' => new RepaymentResource($this->whenLoaded('repaymentInfo')),
        ];
    }

     public function with($request)
    {
        return [
            'totalSum' => $this->resource['totalSum'] ?? null,
            'totalSumBalance' => $this->resource['totalSumBalance'] ?? null,
            'beneficiariesCount' => $this->resource['beneficiariesCount'] ?? null,
        ];
    }


}
