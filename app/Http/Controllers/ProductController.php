<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductSaveRequest;
use App\Stock;
use App\Product;
use App\Sale;
use Validator;

class ProductController extends Controller
{
    //Products

    public function getAllProducts() {
        $products = Product::get()->toJson(JSON_PRETTY_PRINT);
        return response($products, 200);

    }

    /* public function createProduct(Request $request) {
        $product = new Product;
        $product->name = $request->name;
        $product->type = $request->type;
        $product->save();

        return response()->json([
            "message" => "product record created"
        ], 201);

    } */

    /* public function productSave(Request $request) {
        $rules = [
            'name' => 'required|min:3',
            'type' => 'required|min:1|max:30',
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $product = Product::create($request->all());
        return response()->json($product, 201);
    } */

    public function productSave(ProductSaveRequest $request) {
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    /* public function getProduct($id) {
        if (Product::where('id', $id)->exists()) {
            $product = Product::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($product, 200);
        } else {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }
    } */

    public function getProduct($id) {
        if (Product::where('id', $id)->exists()) {
            $product = Product::with('product_categories')->get();
            return response()->json($product, 200);
        } else {
            return response()->json([
                "message" => "Product not found"
            ], 404);
        }
    }

    /* public function getProduct($id)
    {
        $product = Product::with('product_categories')->get();
        return response()->json($product, 200);
    } */

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
}
