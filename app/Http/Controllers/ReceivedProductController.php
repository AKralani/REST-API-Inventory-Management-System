<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReceivedProductSaveRequest;
use App\Http\Requests\ReceivedProductUpdateRequest;
use App\Stock;
use App\ReceivedProduct;
use Validator;

class ReceivedProductController extends Controller
{
    public function getAllReceivedProducts() {
        $receivedProducts = ReceivedProduct::get()->toJson(JSON_PRETTY_PRINT);
        return response($receivedProducts, 200);
    }

    public function receivedProductSave(ReceivedProductSaveRequest $request) {

        if (Stock::where('product_id', $request->product_id)->exists()) {
            $rules = [
                /* 'product_id' => 'required',
                'total_amount' => 'required|numeric|min:1|max:100' */
            ];
    
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $receivedProduct = ReceivedProduct::create($request->all());
    
            $stock = Stock::where('product_id', $request->product_id)->first();
            $stock->increment('quantity', $request->total_amount);
    
            return response()->json($receivedProduct, 201);
        } else {
            //return "Product with this ID doesn't exeists in DB. Pls first register this product!";
            return response()->json([
                "message" => "Product ID not found"
            ], 404);
        }

        
    }

    public function getReceivedProduct($id) {
        if (ReceivedProduct::where('id', $id)->exists()) {
            $receivedProduct = ReceivedProduct::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($receivedProduct, 200);
        } else {
            return response()->json([
                "message" => "Received Product not found"
            ], 404);
        }
    }

    public function updateReceivedProduct(Request $request, $id) {
        if (ReceivedProduct::where('id', $id)->exists()) {
            $receivedProduct = ReceivedProduct::find($id);
            $receivedProduct->product_id = is_null($request->product_id) ? $receivedProduct->product_id : $request->product_id;
            $receivedProduct->total_amount = is_null($request->total_amount) ? $receivedProduct->total_amount : $request->total_amount;
            //$receivedProduct->description = is_null($request->description) ? $receivedProduct->description : $request->description;
            $receivedProduct->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Received Product not found"
            ], 404);
        }
    }

    public function deleteReceivedProduct ($id) {
        if (ReceivedProduct::where('id', $id)->exists()) {
            $receivedProduct = ReceivedProduct::find($id);
            $receivedProduct->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Received Product not found"
            ], 404);
        }
    }
}
