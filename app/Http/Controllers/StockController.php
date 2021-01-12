<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;
use App\Product;
use App\Sale;
use Validator;

class StockController extends Controller
{
    public function getAllStocks() {
        $stocks = Stock::get()->toJson(JSON_PRETTY_PRINT);
        return response($stocks, 200);
    }

    /* public function createStock(Request $request) {
        $stock = new Stock;
        $stock->description = $request->description;
        $stock->quantity = $request->quantity;
        $stock->save();

        return response()->json([
            "message" => "stock record created"
        ], 201);
        /* $stock = new Stock;
        $stock= $request->all();
        $stock->save();
    } */
    public function stockSave(Request $request) {
        $rules = [
            'description' => 'required|min:3',
            'quantity' => 'required|min:1|max:3',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $stock = Stock::create($request->all());
        return response()->json($stock, 201);
    }

    /* public function stockByID($id) {
        $stock = Stock::find($id);
        if(is_null($stock)) {
            return response()->json(["message" => "Record not found!"], 404);
        }

        return response()->json($stock, 200);
    } */

    public function getStock($id) {
        if (Stock::where('id', $id)->exists()) {
            $stock = Stock::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($stock, 200);
        } else {
            return response()->json([
                "message" => "Stock not found"
            ], 404);
        }
    }

    /* public function updateStock(Request $request, $id) {
        $rules = [
            'description' => 'required|min:3',
            'quantity' => 'required|min:1|max:3',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        if (Stock::where('id', $id)->exists()) {
            $stock = Stock::find($id);
            $stock->description = is_null($request->description) ? $stock->description : $request->description;
            $stock->quantity = is_null($request->quantity) ? $stock->quantity : $request->quantity;
            $stock->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Stock not found"
            ], 404);
        }
    } */

    public function updateStock(Request $request, $id) {
        $rules = [
            'description' => 'required|min:3',
            'quantity' => 'required|min:1|max:3',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        if (Stock::where('id', $id)->exists()) {
            $stock = Stock::find($id);
            $stock->description = is_null($request->description) ? $stock->description : $request->description;
            $stock->quantity = is_null($request->quantity) ? $stock->quantity : $request->quantity;
            $stock->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Stock not found"
            ], 404);
        }
    }

    /* public function stockUpdate(Request $request, $id) {
        $stock = Stock::find($id);
        if(is_null($stock)) {
            return response()->json(["message" => "Record not found!"], 404);
        }
        $stock->update($request->all());
        return response()->json($stock, 200);
    } */

    public function deleteStock ($id) {
        if(Stock::where('id', $id)->exists()) {
            $stock = Stock::find($id);
            $stock->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Stock not found"
            ], 404);
        }
    }
    /* public function stockDelete(Request $request, $id) {
        if(is_null($stock)) {
            return response()->json(["message" => "Record not found!"], 404);
        }
        $stock->delete();
        return response()->json(null, 204);
    } */
}
