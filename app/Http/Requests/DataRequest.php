<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Personal;

class DataRequest extends FormRequest
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

        $personalInfo = Personal::create([
            'last_name' => $data['last_name'],
            'maiden_name' => $data['maiden_name'],
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'name_ext' => $data['name_ext'],
            'course' => $data['course'],
            'month_year_graduated' => $data['month_year_graduated'],
            'sex' => $data['sex'],
            'comaker' => $data['comaker'],
            'hei' => $data['hei'],
            'contact_number' => $data['contact_number'],
            'address' => $data['address'],
            'email' => $data['email'],
        ]);

        $personalInfo->employmentInfo()->create([
            'first_date_employment' => $data['first_date_employment'],
            'company_name' => $data['company_name'],
            'job_title' => $data['job_title'],
            'department' => $data['department'],
            'company_address' => $data['company_address'],
            'no_years_emp' => $data['no_years_emp'],
        ]);

        $personalInfo->statusInfo()->create([
            'status' => $data['status'],
            'submitted_nbi' => $data['submitted_nbi'],
        ]);
        $personalInfo->disbursementInfo()->create([
            'principal_loan' => $data['principal_loan'],
            'interest_during_repayment_period' => $data['interest_during_repayment_period'],
            'penalty' => $data['penalty'],
            'total_full_amortization' => $data['total_full_amortization'],
        ]);

        $personalInfo->repaymentInfo()->create([
            'date_paid' => $data['date_paid'],
            'amount_paid' => $data['amount_paid'],
            'confirmation_number' => $data['confirmation_number'],
            'total_amount_paid' => $data['total_amount_paid'],
        ]);

        return $personalInfo->load('employmentInfo', 'statusInfo', 'disbursementInfo', 'repaymentInfo');

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'last_name' => 'required',
            'maiden_name' => 'nullable',
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'name_ext' => 'nullable',
            'course' => 'nullable',
            'month_year_graduated' => 'nullable',
            'sex' => 'required',
            'comaker' => 'nullable',
            'hei' => 'nullable',
            'contact_number' => 'nullable',
            'address' => 'nullable',
            'email' => 'nullable',
            'first_date_employment' => 'nullable',
            'company_name' => 'nullable',
            'job_title' => 'nullable',
            'department' => 'nullable',
            'company_address' => 'nullable',
            'no_years_emp' => 'nullable',
            'status' => 'nullable',
            'submitted_nbi' => 'nullable',
            'principal_loan' => 'required',
            'interest_during_repayment_period' => 'required',
            'penalty' => 'required',
            'total_full_amortization' => 'required',
            'date_paid' => 'nullable',
            'amount_paid' => 'nullable',
            'confirmation_number' => 'nullable',
            'total_amount_paid' => 'required'
        ];
    }

}
