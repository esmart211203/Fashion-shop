<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function changePassword(Request $request){
        $validatedData = $request->validate([
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|min:6',
        ]);
        // kiểm tra coi match password với mk của user đó không
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Không khẩu cũ không chính xác!");
        }
        if ($request->new_password === $request->confirm_password) {
            $password = Hash::make($request->new_password);
            User::whereId(auth()->user()->id)->update([
                'password' => $password //đã hash rồi nhen
            ]);
        } else {
            return back()->with("error_confirm_password", "Mật khẩu mới và xác nhận mật khẩu không khớp!");
        }
        return response()->json(['success' => 'success'], 200);
    }
    public function profile(Request $request){
        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return view('frontend.pages.profile', compact('user'));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'role' => 'required|in:admin,user',
        ]);
        if ($request->password !== $request->password_confirmation) {
            return redirect()->back()->withInput()->withErrors(['password_confirmation' => 'The password confirmation does not match.']);
        }
        return 'check';
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
        return view('admin.user.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
