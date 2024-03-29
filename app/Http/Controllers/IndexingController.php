<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
class IndexingController extends Controller
{
    public function index()
    {
        $featured_pro = Product::where('featured', 1)->take(8)->get();
        $new_pro = Product::orderBy('created_at', 'desc')->take(8)->get();
        return view('frontend.index', compact('featured_pro','new_pro'));
    }
    public function search() {
        $keyword = request()->keyword;
        $products = Product::with('category', 'brand')
        ->where('name', 'like', "%$keyword%")
        ->orWhereHas('category', function ($query) use ($keyword) {
            $query->where('name', 'like', "%$keyword%");
        })
        ->orWhereHas('brand', function ($query) use ($keyword) {
            $query->where('name', 'like', "%$keyword%");
        })
        ->orWhere('description', 'like', "%$keyword%")
        ->paginate(1);
        return view('frontend.pages.result_search', compact('products'));
    }
    
    
}
