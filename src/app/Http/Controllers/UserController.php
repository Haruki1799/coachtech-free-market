<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function login(UserRequest $request)
    {
        $User = $request->only(['email','password']);
        return view('index');
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

    public function mypage()
    {
        return view('mypage_profile');
    }
}