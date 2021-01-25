<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
//use Validator;

class ProductSaveRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //$validator = Validator;
        //if($validator->fails()) {
            return [
                'name' => 'required|min:3',
                'type_id' => 'required|min:1|max:30',
                'description' => 'required|min:5|max:50',
                'price' => 'required|min:1|max:6',
                //'stock' => 'required|min:1|max:4',
            ];
    }
    
//qita jom met me e nreq
    public function messages()
    {
        return [
            'name.required'=> 'Name is Required',
            'type_id.min'=> 'Type  is Required',
            'description.required'=> 'Description is Required',
            'price.required'=> 'Price is Required',
            //'stock.required'=> 'Stock is Required',
        ];
    }
        //}
        
        /* return [
            'name' => 'required|min:3',
            'type' => 'required|min:1|max:30',
            'description' => 'required|min:5|max:50',
            'price' => 'required|min:1|max:6',
            'stock' => 'required|min:1|max:4',
        ]; */
        /* $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        } */

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
