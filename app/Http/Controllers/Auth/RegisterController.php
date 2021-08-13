<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function new_user(Request $request)
    {
        // バリデーション
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed'
        ]);

        // Userモデルに送って、DBに登録
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 登録したその場でログインも同時進行
        auth()->attempt($request->only('email', 'password'));

        // ホーム画面に遷移
        return redirect()->route('home')->with('register_success', 'myLaravelAppへようこそ');
    }
}