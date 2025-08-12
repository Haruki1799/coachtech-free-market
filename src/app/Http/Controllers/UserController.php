<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Good;
use App\Http\Requests\UserRequest;
use App\Http\Requests\RegisterRequest;


class UserController extends Controller
{

    public function login(UserRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'ログイン情報が登録されいません',
        ]);
    }

    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->login($user);

        return redirect()->route('mypage_profile');
    }

    public function mypage_profile()
    {
        return view('mypage_profile');
    }
    public function mypage()
    {
        $goods = Good::where('user_id', Auth::id())->get();
        $user = Auth::user()->load('address');


        return view('mypage', compact('goods', 'user'));
    }
}

