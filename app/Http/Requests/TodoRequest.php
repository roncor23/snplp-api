<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

class TodoRequest extends FormRequest
{

    public $todo;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function save() {
        return Product::create($this->validated());
    }


    // public function save() {

    //     $this->todo = Product::create($request->all());


    //     return $this->todo;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required',
            'price' => 'required'
        ];
    }
}
