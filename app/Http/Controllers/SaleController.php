<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;
use App\Product;
use App\Sale;
use Validator;
use DB;

class SaleController extends Controller
{
    //Sales

    public function getAllSales() {
        $sales = Sale::get()->toJson(JSON_PRETTY_PRINT);
        return response($sales, 200);
    }

    /* public function createSale(Request $request) {
        $sale = new Sale;
        $sale->description = $request->description;
        $sale->save();

        return response()->json([
            "message" => "stock record created"
        ], 201);
    } */

    public function saleSave(Request $request) {
        $rules = [
            'description' => 'required|min:3',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $sale = Sale::create($request->all());
        //qitu jom met
        $total_amount = DB::table('sales')->where('description', 'Buke')->value('total_amount');
        /* $total_amount = DB::table('sales')
            ->select('total_amount')
            ->get();
        DB::table('stocks')->decrement('quantity', $total_amount); */
        DB::table('stocks')->decrement('quantity', $total_amount);
        return response()->json($sale, 201);
    }

    public function getSale($id) {
        if (Sale::where('id', $id)->exists()) {
            $sale = Sale::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($sale, 200);
        } else {
            return response()->json([
                "message" => "Sale not found"
            ], 404);
        }
    }

    public function updateSale(Request $request, $id) {
        if (Sale::where('id', $id)->exists()) {
            $sale = Sale::find($id);
            $sale->description = is_null($request->description) ? $sale->description : $request->description;
            $sale->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Sale not found"
            ], 404);
        }
    }

    public function deleteSale ($id) {
        if(Sale::where('id', $id)->exists()) {
            $sale = Sale::find($id);
            $sale->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Sale not found"
            ], 404);
        }
    }
}
