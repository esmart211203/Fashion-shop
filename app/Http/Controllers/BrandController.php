<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;        
use App\Models\Category;     
use Illuminate\Support\Facades\Validator;                                     ;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brand.index', compact('brands'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.brand.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'required|string|max:255',
            'category_id' => 'required',
        ]);
        if (empty($validatedData)) {
            return response()->json(['errors' => 'Validation failed'], 400);
        }
        try {
            $brand = new Brand();
            $brand->name = $validatedData['name'];
            $brand->description = $validatedData['description'];
            $brand->category_id = $validatedData['category_id'];
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = trim($validatedData['name']). '-'.time().rand(1,999). '.' .$image->extension();
                $image->move(public_path('images/brand'), $filename);
                $brand->image = $filename;
            }
            $brand->save();
            //return response()->json(['message' => 'Category created successfully'], 200);
            return redirect()->route('brands.index')->with('success', 'Thêm thành công!');
        } catch (\Exception $e) {
           //Log::error('Failed to create category', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to create brand'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::find($id);
        $categories = Category::all();
        return view('admin.brand.edit', compact('brand', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return response()->json(['error' => 'Brand not found'], 404);
        }
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'required|string|max:255',
            'category_id' => 'required',
        ]);
        $previousImage = $brand->image;
        $brand->name = $validatedData['name'];
        $brand->description = $validatedData['description'];
        $brand->category_id = $validatedData['category_id'];
        // image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $validatedData['name'] . '-' . time() . rand(1, 999) . '.' . $image->extension();
            $image->move(public_path('images/brand'), $filename);
            // del image
            if ($previousImage) {
                $oldImagePath = public_path('images/brand') . '/' . $previousImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $brand->image = $filename;
        } else {
            $brand->image = $previousImage ? $previousImage : '';
        }
        $brand->save();
    
        return redirect()->route('brands.index')->with('update', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return response()->json(['error' => 'brand not found'], 404);
        }
        if ($brand->image) {
            $brand_image = public_path('images/brand') . '/' . $brand->image;
            if (file_exists($brand_image)) {
                unlink($brand_image);
            }
        }
        $brand->delete();
        return redirect()->route('brands.index')->with('delete', 'Xóa thành công!');
        //return response()->json(['message' => 'Brand deleted successfully'], 200);
    }
}
