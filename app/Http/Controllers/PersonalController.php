<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DataRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\FetchRequest;
use App\Http\Resources\PersonalResource;


class PersonalController extends Controller
{

    public function index(FetchRequest $request) {
        
        return PersonalResource::collection($request->getData());
        
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


}
