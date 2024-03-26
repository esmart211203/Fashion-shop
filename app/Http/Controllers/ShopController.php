<?php

namespace App\Http\Controllers;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_image;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function viewShop(){
        $categories = Category::all();
        $products = Product::all();
        return view('.frontend.shop.index',compact('categories','products'));
    }
    public function viewShopCategory($category_id){
        $categories = Category::all();
        $products = Product::where('category_id', $category_id)->get();
        return view('.frontend.shop.shop_category',compact('categories','products'));
    }
    public function shopSingle($product_id){
        $product = Product::find($product_id);
        if(!$product){
            return response()->json(['errors' => 'Product not found'], 404);
        }
        $product_images = Product_image::where('product_id', $product->id)->get();
        return view('.frontend.shop.shop_single',compact('product','product_images'));
    }
}
