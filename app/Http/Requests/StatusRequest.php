<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Statuses;

class StatusRequest extends FormRequest
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

    public function saveData() {

        $data = $this->validated();


        $status = Statuses::create([
            'personal_id' => $data['personal_id'],
            'date' => $data['date'],
            'action_taken' => $data['action_taken'],
            'encoded_by' => "test",
        ]);

        return $status;
    }

    public function updateBenefeciaryStatusData($id) {

        $data = $this->validated();

        $status = Statuses::findOrFail($id);

        $status->update([
            'personal_id' => $data['personal_id'],
            'date' => $data['date'],
            'action_taken' => $data['action_taken'],
            'encoded_by' => "test",
        ]);

        return $status;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'personal_id' => 'required',
            'date' => 'required',
            'action_taken' => 'required',
        ];
    }
}
