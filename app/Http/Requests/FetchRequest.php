<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Personal;
use App\Models\Statuses;
use App\Models\Disbursement;
use App\Models\Payment;
use App\Models\Repayment;
use Illuminate\Support\Facades\DB;


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

    public function searchByLastFirstName($search) {

        return Personal::with('employmentInfo', 'statusInfo', 'disbursementInfo', 'repaymentInfo')
        ->where('first_name', strtoupper($search))
        ->orWhere('last_name', strtoupper($search))
        ->get();

    }

    public function getSingleData($id) {

        return Personal::with('employmentInfo', 'statusInfo', 'disbursementInfo', 'repaymentInfo')->where('id', $id)->get();             
    }

    public function getPaymentsPerBeneficiary($id) {
        return Payment::where('personal_id', $id)->get();
    }

    public function getStatusesPerBeneficiary($id) {
        return Statuses::where('personal_id', $id)->get();
    }

    public function getData($page) {

        return Personal::with('employmentInfo', 'statusInfo', 'disbursementInfo', 'repaymentInfo')
                ->paginate(10, ['*'], 'page', $page);
        
    }

    public function getDataByStatus($status, $page) {
        if($status == 1) {

            $personalData = Personal::with('employmentInfo', 'statusInfo', 'disbursementInfo', 'repaymentInfo')
            ->whereHas('disbursementInfo', function ($query) {
                $query->whereExists(function ($subquery) {
                    $subquery->select(DB::raw(1))
                        ->from('repayments')
                        ->whereRaw('repayments.personal_id = disbursements.personal_id')
                        ->whereRaw('disbursements.total_full_amortization = repayments.total_amount_paid');
                });
            })
            ->paginate(10, ['*'], 'page', $page);


            $totalPaid = Personal::with('employmentInfo', 'statusInfo', 'disbursementInfo', 'repaymentInfo')
             ->whereHas('disbursementInfo', function ($query) {
                 $query->whereExists(function ($subquery) {
                     $subquery->select(DB::raw(1))
                         ->from('repayments')
                        ->whereRaw('repayments.personal_id = disbursements.personal_id')
                        ->whereRaw('disbursements.total_full_amortization = repayments.total_amount_paid');
                 });
             })
             ->get();  
  

             // Calculate the total sum of total_amount_paid
            $totalSumPaid = $totalPaid->sum(function ($item) {
                return $item->repaymentInfo->total_amount_paid;
            });

            $totalSumBalance = $totalPaid->sum(function ($item) {
                return $item->repaymentInfo->outstanding_balance;
            });

            return [
                'personalData' => $personalData,
                'totalSumPaid' => $totalSumPaid,
                'totalSumBalance' => $totalSumBalance,
                'beneficiariesCount' => $totalPaid->count(),
            ];

        
        }
        if($status == 0) {
            $personalData = Personal::with('employmentInfo', 'statusInfo', 'disbursementInfo', 'repaymentInfo')
            ->whereHas('disbursementInfo', function ($query) {
                $query->whereExists(function ($subquery) {
                    $subquery->select(DB::raw(1))
                        ->from('repayments')
                        ->whereRaw('repayments.personal_id = disbursements.personal_id')
                        ->whereRaw('disbursements.total_full_amortization <> repayments.total_amount_paid');
                });
            })
            ->paginate(10, ['*'], 'page', $page);


            $totalPaid = Personal::with('employmentInfo', 'statusInfo', 'disbursementInfo', 'repaymentInfo')
             ->whereHas('disbursementInfo', function ($query) {
                 $query->whereExists(function ($subquery) {
                     $subquery->select(DB::raw(1))
                         ->from('repayments')
                        ->whereRaw('repayments.personal_id = disbursements.personal_id')
                         ->whereRaw('disbursements.total_full_amortization <> repayments.total_amount_paid');
                 });
             })
             ->get();  
  

             // Calculate the total sum of total_amount_paid
            $totalSumPaid = $totalPaid->sum(function ($item) {
                return $item->repaymentInfo->total_amount_paid;
            });

            $totalSumBalance = $totalPaid->sum(function ($item) {
                return $item->repaymentInfo->outstanding_balance;
            });

            return [
                'personalData' => $personalData,
                'totalSumPaid' => $totalSumPaid,
                'totalSumBalance' => $totalSumBalance,
                'beneficiariesCount' => $totalPaid->count(),
            ];
        
        }

        if($status == 2) {
            $personalData = Personal::with('employmentInfo', 'statusInfo', 'disbursementInfo', 'repaymentInfo')
            ->whereHas('repaymentInfo', function ($query) {
                $query->where('total_amount_paid', 0);
            })
            ->paginate(10, ['*'], 'page', $page);


            $totalPaid = Personal::with('employmentInfo', 'statusInfo', 'disbursementInfo', 'repaymentInfo')
            ->whereHas('repaymentInfo', function ($query) {
                $query->where('total_amount_paid', 0);
            })
             ->get();  
  

             // Calculate the total sum of total_amount_paid
            $totalSumPaid = $totalPaid->sum(function ($item) {
                return $item->repaymentInfo->total_amount_paid;
            });

            $totalSumBalance = $totalPaid->sum(function ($item) {
                return $item->repaymentInfo->outstanding_balance;
            });

            return [
                'personalData' => $personalData,
                'totalSumPaid' => $totalSumPaid,
                'totalSumBalance' => $totalSumBalance,
                'beneficiariesCount' => $totalPaid->count(),
            ];
        
        }

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
