<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Payment;

class PaymentRequest extends FormRequest
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


        $payment = Payment::create([
            'personal_id' => $data['personal_id'],
            'date_paid' => $data['date_paid'],
            'amount_paid' => $data['amount_paid'],
            'confirmation_number' => $data['confirmation_number'],
        ]);

        return $payment;
    }

    public function updateBenefeciaryData($id) {
        $data = $this->validated();

        $payment = Payment::findOrFail($id);

        $payment->update([
            'personal_id' => $data['personal_id'],
            'date_paid' => $data['date_paid'],
            'amount_paid' => $data['amount_paid'],
            'confirmation_number' => $data['confirmation_number'],

        ]);

        return $payment;
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
            'date_paid' => 'required',
            'amount_paid' => 'required',
            'confirmation_number' => 'required',
        ];
    }
}
