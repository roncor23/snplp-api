<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Http\Requests\FetchRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\DeleteRequest;

class PaymentController extends Controller
{
    public function store(PaymentRequest $request) {

        return new PaymentResource($request->saveData());

    }

    public function per_beneficiary(FetchRequest $request, $id) {

        return PaymentResource::collection($request->getPaymentsPerBeneficiary($id));

    }

    public function update(PaymentRequest $request, $id) {

        return new PaymentResource($request->updateBenefeciaryData($id));

    }

    public function delete(DeleteRequest $request, $id) {
        return $request->deletePayment($id);
    }
}
