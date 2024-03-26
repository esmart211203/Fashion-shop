<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexingController extends Controller
{
    public function index()
    {
        $featured_pro = Product::where('featured', 1)->take(8)->get();
        $new_pro = Product::orderBy('created_at', 'desc')->take(8)->get();
        return view('frontend.index', compact('featured_pro','new_pro'));
    }
    
}
