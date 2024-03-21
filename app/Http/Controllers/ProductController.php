<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use App\Models\Product_image;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $status = [
            'available' => 'available',
            'out_of_stock' => 'out_of_stock',
            'discontinued' => 'discontinued',
            'pre_order' => 'pre_order',
        ];
        return view('admin.product.create', compact('categories','brands','status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateProduct = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required|min:0',
            'status' => 'required|string|max:255',
            'quantity_in_stock' => 'required|min:1|max:100',
            'description' => 'required|string|max:255',
        ]);
        $validateProduct['featured'] = isset($request->feature) ? 1 : 0;
        $product = Product::create($validateProduct);
    
        $validatorProductImages = $request->validate([
            'images.*' => 'required|image',
        ]);
    
        if ($request->has('images')) {
            foreach ($request->file('images') as $value) {
                $image_name = 'pro-imgs-' . time() . rand(1, 1000) . '.' . $value->extension();
                $value->move(public_path('images/product_images'), $image_name);
                Product_image::create([
                    'name' => $image_name,
                    'product_id' => $product->id,
                ]);
            }
        }
        return response()->json(['success' => 'success'], 200);
    }
    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view('.frontend.pages.detail_product');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $product_images = Product_image::where('product_id', $product->id)->get();
        $brands = Brand::all();
        $categories = Category::all();
        $status = [
            'available' => 'available',
            'out_of_stock' => 'out_of_stock',
            'discontinued' => 'discontinued',
            'pre_order' => 'pre_order',
        ];
        return view('admin.product.edit', compact("product","product_images","brands","categories","status"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        if(!$product){
            return response()->json(['errors' => 'Product not found'], 404);
        }
    
        // Validate product fields
        $validatedProduct = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'brand_id' => 'required',
            'price' => 'required|min:1',
            'status' => 'required|string|max:255',
            'quantity_in_stock' => 'required|min:1|max:1000',
            'description' => 'required|string|max:255',
        ]);
    
        // Update product fields
        $product->name = $validatedProduct['name'];
        $product->category_id = $validatedProduct['category_id'];
        $product->brand_id = $validatedProduct['brand_id'];
        $product->price = $validatedProduct['price'];
        $product->quantity_in_stock = $validatedProduct['quantity_in_stock'];
        $product->description = $validatedProduct['description'];
        $product->featured = isset($request->feature) ? 1 : 0;
    
        // Save updated product
        $product->save();
    
        // Handle product images
        if ($request->has('images')) {
            foreach ($request->file('images') as $image) {
                $image_name = 'pro-imgs-' . time() . rand(1, 1000) . '.' . $image->extension();
                $image->move(public_path('images/product_images'), $image_name);
                Product_image::create([
                    'name' => $image_name,
                    'product_id' => $product->id,
                ]);
            }
        }
    
        return redirect()->route('products.index');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        $product = Product::find($id);
        if($product){
            $product->delete();
            $product_images = Product_image::where('product_id', $product->id)->get();
            foreach ($product_images as $product_image) {
                $imagePath = public_path('images/product_images/' . $product_image->name);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
            // để cái này ở dưới vì nó xóa cmnr thì thg kia tìm tên ra thế đ nào đc mà xóa kkkkk - TrongKotD
            Product_image::where('product_id', $product->id)->delete();
        }else{
            return response()->json(['erros' => 'product not found'], 404);
        }
        return response()->json(['success' => 'success'], 200);
    }
    
    public function delete_prouct_image($pro_image_id){
        $product_image = Product_image::find($pro_image_id);
        if ($product_image) {
            $product_image->delete();
            return response()->json(['success' => true, 'message' => 'Image deleted successfully'], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Image not found'], 404);
        }
    }
}  
