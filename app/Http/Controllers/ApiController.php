<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;
use App\Product;
use App\Sale;

class ApiController extends Controller
{
    public function getAllStocks() {
        $stocks = Stock::get()->toJson(JSON_PRETTY_PRINT);
        return response($stocks, 200);
    }

    public function createStock(Request $request) {
        $stock = new Stock;
        $stock->description = $request->description;
        $stock->quantity = $request->quantity;
        $stock->save();

        return response()->json([
            "message" => "stock record created"
        ], 201);
        /* $stock = new Stock;
        $stock= $request->all();
        $stock->save(); */
    }

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

    public function updateStock(Request $request, $id) {
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

    
    //Products

    public function getAllProducts() {
        $products = Product::get()->toJson(JSON_PRETTY_PRINT);
        return response($products, 200);

    }

    public function createProduct(Request $request) {
        $product = new Product;
        $product->name = $request->name;
        $product->type = $request->type;
        $product->save();

        return response()->json([
            "message" => "product record created"
        ], 201);

    }

    public function getProduct($id) {
        if (Product::where('id', $id)->exists()) {
            $product = Product::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($product, 200);
        } else {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }
    }

    public function updateProduct(Request $request, $id) {
        if (Product::where('id', $id)->exists()) {
            $product = Product::find($id);
            $product->name = is_null($request->name) ? $product->name : $request->name;
            $product->type = is_null($request->type) ? $product->type : $request->type;
            $product->save();

            return response()->json([
                "message" => "records updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }
    }

    public function deleteProduct ($id) {
        if(Product::where('id', $id)->exists()) {
            $product = Product::find($id);
            $product->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }
    }


    //Sales

    public function getAllSales() {
        $sales = Sale::get()->toJson(JSON_PRETTY_PRINT);
        return response($sales, 200);
    }

    public function createSale(Request $request) {
        $sale = new Sale;
        $sale->description = $request->description;
        $sale->save();

        return response()->json([
            "message" => "stock record created"
        ], 201);
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