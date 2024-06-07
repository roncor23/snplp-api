<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DataRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\FetchRequest;
use App\Http\Resources\PersonalResource;


class PersonalController extends Controller
{

    public function index(FetchRequest $request, $page) {
        
        return PersonalResource::collection($request->getData($page));
        
    }

    public function searchByBeneficiaries(FetchRequest $request, $search) {

        return $request->searchByLastFirstName($search);
        
    }

    public function fetchByStatus(FetchRequest $request, $page, $status) {

        $personalData = $request->getDataByStatus($page, $status);
        $paginator = $personalData['personalData'] ?? null;
        $totalSumPaid = $personalData['totalSumPaid'] ?? null;
        $totalSumBalance = $personalData['totalSumBalance'] ?? null;
        $beneficiariesCount = $personalData['beneficiariesCount'] ?? null;

        return [
            'data' => PersonalResource::collection($paginator->items()),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
            ],
            'totalSumPaid' => $totalSumPaid,
            'totalSumBalance' => $totalSumBalance,
            'beneficiariesCount' => $beneficiariesCount,
        ];

    }

    public function store(DataRequest $request) {

        return new PersonalResource($request->saveData());

    }

    public function show(FetchRequest $request, $id) {

        return PersonalResource::collection($request->getSingleData($id));

    }

    public function update(UpdateRequest $request, $id) {

        return new PersonalResource($request->updateData($id));

    }

    public function get_total_loan(FetchRequest $request) {

        return $request->getTotalLoan();
    }

    public function get_total_interest(FetchRequest $request) {

        return $request->getTotalInterest();
    }

    public function get_total_penalty(FetchRequest $request) {

        return $request->getTotalPenalty();
    }

    public function get_total_amortization(FetchRequest $request) {
        return $request->getTotalAmortization();
    }

    public function get_total_amount_paid(FetchRequest $request) {
        return $request->getTotalAmountPaid();
    }


}
