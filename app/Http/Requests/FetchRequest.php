<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Personal;


class FetchRequest extends FormRequest
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

    public function getSingleData($id) {

        return Personal::with('employmentInfo', 'statusInfo', 'disbursementInfo', 'repaymentInfo')->where('id', $id)->get();
                  
    }

    public function getData() {

        return Personal::with('employmentInfo', 'statusInfo', 'disbursementInfo', 'repaymentInfo')->get();

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
