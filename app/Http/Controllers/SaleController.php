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
        /* $rules = [
            'description' => 'required|min:3',
            'total_amount' => 'required|lte:20'
        ]; */

        //first retrieves an array BUT removes everything and produces only the required field value
        $stock = Stock::where('product_id', $request->product_id)->firstOrFail();
        $qty = $stock->quantity;
        $rules = [
            'description' => 'required',
            'product_id' => 'required',
            'total_amount' => 'required|numeric|min:1|max:'.$qty,
            'price' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $sale = Sale::create($request->all());
        //qitu jom met
        //$total_amount = DB::table('sales')->where('description', 'Buke')->value('total_amount');
        /* $total_amount = DB::table('sales')
            ->select('total_amount')
            ->get();
        DB::table('stocks')->decrement('quantity', $total_amount); */

        $stock = Stock::where('product_id', $request->product_id)->first();
        $stock->decrement('quantity', $request->total_amount);
        // DB::table('stocks')->decrement('quantity', $total_amount);
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
            $sale->product_id = is_null($request->product_id) ? $sale->product_id : $request->product_id;
            $sale->total_amount = is_null($request->total_amount) ? $sale->total_amount : $request->total_amount;
            $sale->total_amount_correct = is_null($request->total_amount_correct) ? $sale->total_amount_correct : $request->total_amount_correct;
            
            $stock = Stock::where('product_id', $request->product_id)->first();
            //$total_amount = Sale::where('total_amount', $request->total_amount)->first();
            //$sale = Sale::where('product_id', $request->product_id)->first();
            //$total_amount = Sale::where('total_amount', $request->total_amount)->get();
            //$total_amount = DB::table('sales')->where('total_amount')->value('total_amount');
            //$total_amount = DB::table('sales')->where('total_amount', $total_amount)->value('total_amount');
            //$total_amount_correct = DB::table('sales')->where('total_amount_correct')->value('total_amount_correct');
            //$total_amount_correct = DB::table('sales')->where('total_amount_correct', $total_amount_correct)->value('total_amount_correct');
            //$stock = Stock::where('product_id', $request->product_id)->first()->value('description');
            $total_amount = Sale::where('product_id', $request->product_id)->first()->value('total_amount');
            $total_amount_correct = Sale::where('product_id', $request->product_id)->first()->value('total_amount_correct');
            //dd($total_amount);
            //dd($total_amount_correct);
            //$total_amount_correct = Sale::where('total_amount_correct', $request->total_amount_correct)->first();
            //$total_amount_correct = Sale::where('total_amount_correct', $request->total_amount_correct)->get();
            //$total_amount = DB::table('sales')->where('total_amount')->first();
            //$total_amount_correct = DB::table('sales')->where('total_amount_correct')->first();
            // if ($request->total_amount_correct == $request->total_amount) // 5 = 5
            if ($total_amount_correct == $total_amount) // 5 = 5
            {
                return "test";
                //$sale->save();
            } else //if ($total_amount_correct != $total_amount) // 5 > 3 || 5 < 3
            {
                $difference_TA = $total_amount_correct - $total_amount;
                $stock->increment('quantity', $difference_TA);
                //$sale->save();
            }
            
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
