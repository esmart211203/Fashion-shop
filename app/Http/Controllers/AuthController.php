<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function viewAdmin(){
        return view('admin.index');
    }
    public function Login(){
        return view('frontend.auth.login');
    }
    public function customLogin(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = [
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ];
    
        if (Auth::attempt($credentials)) {
            // Xác thực thành công
            // Đánh dấu người dùng đã đăng nhập thành công
            // Chuyển hướng đến trang chủ hoặc trang mong muốn
            return 'dang nhap thanh cong';
        } else {
            // Xác thực không thành công
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }
    }
}
