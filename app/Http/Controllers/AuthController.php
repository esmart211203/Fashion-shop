<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(){
    }
    public function viewAdmin(){
        return view('admin.index');
    }
    public function Login(){
        return view('frontend.auth.login');
    }
    public function customLogin(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $credentials = [
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ];
        if (Auth::attempt($credentials)) {
            return redirect()->route('index');
        } else {
            // Xác thực không thành công
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }
    }
    public function register(){
        return view('frontend.auth.register');
    }
    public function logout(Request $request){
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return redirect()->route('login');
    }
    public function customRegister(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8',
            'avatar' => 'nullable|image|max:2048',
        ]);
        
        $user = new User([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'customer',
        ]);
        
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarPath = $avatar->store('images/users', 'public');
            $user->avatar = $avatarPath;
        }
        
        $user->save();
        
        auth()->login($user);
        
        return redirect()->route('index');
    }
}
