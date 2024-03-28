<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Orderitem;
use Mail;
class OrderController extends Controller
{
    public function __construct(){

    }
    public function checkOut(Request $request){
        $user = $request->user();
        /**
         * TrongKotd toturial
         * Các bước cần thực hiện để làm hàm này
         * Tạo 1 bản ghi order của người dùng
         * Tạo orderitems theo order_id sản phẩm là tất cả sản phẩm trong cart
         * Xóa giỏ hàng
         */
        // B1: Tạo bản ghi order
        // Validator data
        $validatedData = $request->validate([
            'receiver' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);
        // lấy giỏ hàng ra
        $cart = Cart::where('user_id', $user->id)->get();
        // Số lượng sản phẩm trong đơn
        $totalAmount = Cart::totalAmount($user->id);
        // Tổng tiền phải trả
        $totalAmountShoppingCart = Cart::totalAmountShoppingCart($user->id);
        // Tạo order
        $status = 'Processing';         // Trạng thái đầu
        $order = new Order([
            'user_id' => $user->id,
            'total_amount' => $totalAmount,
            'price' => $totalAmountShoppingCart,
            'status' => $status,
            'receiver' => $validatedData['receiver'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
        ]);
        $order->save();
        // B2: Tạo orderitems theo order_id sản phẩm là tất cả sản phẩm trong cart
        $cart_items = Cart::where('user_id', $user->id)->get();                                          
        foreach ($cart_items as $item) {
            // lấy sản phẩm theo id trong giỏ á
            $product = Product::find($item->product_id);
            $price = $product->price * $item->quantity; // lấy giá nhân số lượng để lấy tổng giá phải trả của sp 
            $orderItem = new OrderItem([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $price, // Giá sẽ lấy giá sản phẩm đó nhân số lượng -
            ]);
            $orderItem->save();
        }
        // B3: Xóa giỏ hàng
        Cart::where('user_id', $user->id)->delete();
        return response()->json(['success' => 'success'], 200);
    }
    public function index(){
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }
    public function destroy($order_id){
        $order = Order::find($order_id);
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
        $order->delete();
        return response()->json(['success' => 'success'], 200);
    }
    public function orderDetail($order_id){
        $order = Order::find($order_id);
        $orderitems = Orderitem::where('order_id', $order->id)->get();
        if (!$order || !$orderitems) {
            return response()->json(['error' => 'Order not found'], 404);
        }
        return view('admin.order.detail', compact('order','orderitems'));
    }
    public function approveOrder($order_id){
        $order = Order::find($order_id);
        if(!$order){
            return response()->json(['error' => 'Order not found'], 404);
        }
        if($order->status !== Order::STATUS_PROCESSING){
            return response()->json(['error' => 'Order status failed'], 404);
        }
        $order->status = Order::STATUS_APPROVED;
        $order->save();
        // Gửi mail cho user đó khi admin đã nhận đơn hàng
        $name = $order->receiver;
        $email_receiver = $order->user->email;
        Mail::send('emails.body', compact('name'), function($email) use ($email_receiver, $name) {
            $email->subject('Thư giới thiệu');
            $email->to($email_receiver, $name);
        });
        
        return response()->json(['update success' => 'success'], 200);
    }
}
