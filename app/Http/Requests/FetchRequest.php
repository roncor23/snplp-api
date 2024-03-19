<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Personal;
use App\Models\Disbursement;
use App\Models\Payment;
use App\Models\Repayment;

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

    public function getPaymentsPerBeneficiary($id) {
        return Payment::where('personal_id', $id)->get();
    }

    public function getData($page) {

        return Personal::with('employmentInfo', 'statusInfo', 'disbursementInfo', 'repaymentInfo')
                ->paginate(10, ['*'], 'page', $page);

    }

    public function getTotalLoan() {

        $disburse = Disbursement::all();

        return $disburse->sum('principal_loan');
    }

    public function getTotalAmountPaid() {

        $repayment = Repayment::all();

        $re = $repayment->sum('total_amount_paid');

        $payment = Payment::all();

        $pay = $payment->sum('amount_paid');

        return $re + $pay;
    }

    public function getTotalInterest() {

        $interest = Disbursement::all();

        return $interest->sum('interest_during_repayment_period');
    }

    public function getTotalPenalty() {

        $penalty = Disbursement::all();

        return $penalty->sum('penalty');
    }

    public function getTotalAmortization() {

        $amortization = Disbursement::all();

        return $amortization->sum('total_full_amortization');
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
