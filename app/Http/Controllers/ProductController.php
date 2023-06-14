<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function get_products(){
        $products = Product::all();
        return response()->json([
            'products' => $products
        ],200);
    }

    public function add_product(Request $request) {
        $product = new Product();

        $file_name = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('/upload/'), $file_name);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $file_name;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;

        $product->save();
    }
}
