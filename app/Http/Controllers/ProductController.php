<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Intervention\Image\Facades\Image;


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

       // $file_name = time() . '.' . request()->image->getClientOriginalExtension();
       // request()->image->move(public_path('/upload'), $file_name);

        if ($request->image!="") {
            $strpos = strpos($request->image, ';');
            $sub = substr($request->image,0,$strpos);
            $ex = explode('/',$sub)[1];
            $name = time().".".$ex;
            $img = Image::make($request->image)->resize(200,200);
            $upload_path = public_path()."/upload/";
            $img->save($upload_path.$name);
        }else{
            $product->image = "image.png";
        }

        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $name;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;

        $product->save();
    }
}
