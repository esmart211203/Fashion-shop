<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.category.create',compact('categories'));
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
            'parent_category_id' => 'nullable',
        ]);
    
        $category = new Category();
        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'];

        if (isset($validatedData['parent_category_id'])) {
            $category->parent_category_id = $validatedData['parent_category_id'];
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $validatedData['name']. '-'.time().rand(1,999). '.' .$image->extension();
            $image->move(public_path('images/category'), $filename);
            $category->image = $filename;
        }
        $category->save();
        return redirect()->route('categories.index')->with('success', 'Sửa thành công!');
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
        $categories = Category::all();
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        return view('admin.category.edit', compact('categories','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'required|string|max:255',
            'parent_category_id' => 'nullable',
        ]);
    
        $previousImage = $category->image;
        $previousParent_cate_id = $category->parent_category_id;
        // update
        $category->name = $validatedData['name'];
        $category->description = $validatedData['description'];
        if (isset($validatedData['parent_category_id'])) {
            $category->parent_category_id = $validatedData['parent_category_id'];
        }else{
            $category->parent_category_id = $previousParent_cate_id;
        }
    
        // image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = $validatedData['name'] . '-' . time() . rand(1, 999) . '.' . $image->extension();
            $image->move(public_path('images/category'), $filename);
            // del image
            if ($previousImage) {
                $oldImagePath = public_path('images/category') . '/' . $previousImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
    
            $category->image = $filename;
        } else {
            $category->image = $previousImage ? $previousImage : '';
        }
    
        $category->save();
    
        return redirect()->route('categories.index')->with('update', 'Sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if ($category) {
            $childCategories = Category::where('parent_category_id', $category->id)->get();
            foreach ($childCategories as $childCategory) {
                $childCategory->parent_category_id = null;
                $childCategory->save();
            }
            if ($category->image) {
                $image_path = public_path("images/category/{$category->image}");
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $category->delete();
            return redirect()->route('categories.index')->with('delete', 'Xóa thành công!');
        }
        return redirect()->route('categories.index');
    }
}
