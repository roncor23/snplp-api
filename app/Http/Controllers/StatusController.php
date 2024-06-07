<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StatusRequest;
use App\Http\Resources\StatusResource;
use App\Http\Requests\FetchRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\DeleteRequest;


class StatusController extends Controller
{
    public function store(StatusRequest $request) {

        return new StatusResource($request->saveData());

    }

    public function per_beneficiary(FetchRequest $request, $id) {

        return StatusResource::collection($request->getStatusesPerBeneficiary($id));

    }

    public function update(StatusRequest $request, $id) {

        return new StatusResource($request->updateBenefeciaryStatusData($id));

    }

    public function delete(DeleteRequest $request, $id) {
        return $request->deleteStatus($id);
    }
}
