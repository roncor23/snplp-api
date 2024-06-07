<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Statuses;
use App\Models\Payment;

class DeleteRequest extends FormRequest
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

    public function deleteStatus($id) {
        
        // Find the status record by its ID
        $status = Statuses::findOrFail($id);

        // Delete the status record from the database
        $status->delete();

        // Optionally, return a response or a boolean to indicate success
        return response()->json([
            'message' => 'Status deleted successfully',
        ], 200);
    }

    public function deletePayment($id) {
        
        // Find the payment record by its ID
        $payment = Payment::findOrFail($id);

        // Delete the payment record from the database
        $payment->delete();

        // Optionally, return a response or a boolean to indicate success
        return response()->json([
            'message' => 'Payment deleted successfully',
        ], 200);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
