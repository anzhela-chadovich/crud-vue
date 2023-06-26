<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class ProductController extends Controller
{
    public function get_products(){
        return ProductResource::collection(Product::all());
    }

    public function add_product(ProductRequest $request)
    {
        $product = new Product();

        if ($request->image!="") {
            $strpos = strpos($request->image, ';');
            $sub = substr($request->image,0,$strpos);
            $ex = explode('/',$sub)[1];
            $name = time().".".$ex;
            $img = Image::make($request->image)->resize(200,200);
            Storage::disk('public') -> put($name, $img->save($name));
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

    public function get_edit_product($id){
        return new ProductResource(Product::find($id));
    }

    public function update_product(ProductRequest $request, $id){
        $product = Product::findOrFail($id);

        if ($product->image!=$request->image) {
            $strpos = strpos($request->image, ';');
            $sub = substr($request->image,0,$strpos);
            $ex = explode('/',$sub)[1];
            $name = time().".".$ex;
            $img = Image::make($request->image)->resize(200,200);
            Storage::disk('public') -> put($name, $img->save($name));
            if(Storage::disk('public')->exists($product->image)){
                Storage::disk('public')->delete($product->image);
            }
            }else {$name = $product->image;}

        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $name;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;

        $product->save();
    }

    public function delete_product($id){
        $product = Product::findOrFail($id);
        Storage::disk('public')->delete($product->image);
        $product->delete();
    }

    public function search_products(Request $request) {
        $search = $request->get('search');
        if($search!=null) {
            return ProductResource::collection(Product::search($search)->get());
        }else{
           return $this->get_products();
        }
    }
}
