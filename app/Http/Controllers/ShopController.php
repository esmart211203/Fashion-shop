<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function viewShop(){
        return view('.frontend.shop.index');
    }
    public function viewShopCategory(){
        return view('.frontend.shop.shop_category');
    }
}
