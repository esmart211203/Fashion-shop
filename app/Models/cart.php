<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];
    public static function totalAmount($user_id){
        if(User::where('id', $user_id)->exists()){
            $cart = Cart::where('user_id', $user_id)->get();
            $total_amount = 0;
            foreach ($cart as $item) {
                $total_amount += $item->quantity;
            }
            return $total_amount;
        } else {
            return -1;
        }
    }
    
    public static function totalAmountShoppingCart($user_id){
        if(!User::where('id', $user_id)->exists()){
            return -1;
        }
        $cart_items = Cart::where('user_id', $user_id)->get();
        $total_amount = 0;
        foreach ($cart_items as $item) {
            $product = Product::find($item->product_id);
            if ($product) {
                $total_amount += $product->price * $item->quantity;
            }
        }
        return $total_amount;
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
