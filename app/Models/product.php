<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\category;
use App\Models\Product_image;
class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand_id',
        'category_id',
        'price',
        'status',
        'featured',//update
        'quantity_in_stock',
        'description',
        'image_url', // Thêm trường ảnh vào danh sách fillable
    ];
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function firstImage()
    {
        return $this->hasOne(Product_image::class, 'product_id')->orderBy('id', 'asc');
    }
    public static function getFirstImage($product_id)
    {
        $firstImage = Product_image::where('product_id', $product_id)->orderBy('id')->first();

        if ($firstImage) {
            return $firstImage->name;
        }

        return null;
    }
}
