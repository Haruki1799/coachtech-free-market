<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Good;
use App\Models\Order;
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
    public function mypage(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['auth' => 'ログインしてください']);
        }

        $user = Auth::user()->load('address');
        $page = $request->input('page');

        if ($page === 'mylist') {
            $orders = Order::with('goods')
                ->where('user_id', Auth::id())
                ->latest()
                ->get();

            $goods = $orders->pluck('goods')->filter(function ($good) {
                return $good && $good->is_sold;
            });
        } else {
            $goods = Good::where('user_id', Auth::id())->get();
        }

        return view('mypage', compact('user', 'goods'));
    }
}

