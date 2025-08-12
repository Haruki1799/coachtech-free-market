<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use App\Models\Goods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(AddressRequest $request)
    {

        $user = Auth::user();

        // ユーザー名は users テーブルに保存
        $user->update([
            'name' => $request->input('name'),
        ]);

        // 画像保存（任意）
        $path = $user->address->profile_image ?? null;
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
        }

        // 住所情報は addresses テーブルに保存
        $user->address()->updateOrCreate([], [
            'post_code' => $request->input('post_code'),
            'address' => $request->input('address'),
            'building' => $request->input('building'),
            'profile_image' => $path,
        ]);

        return redirect('/');
    }

    public function edit()
    {
        $user = Auth::user();
        $address = $user->address;

        return view('mypage_profile', compact('user', 'address'));
    }

    public function editForItem($item_id)
    {
        $goods = Goods::findOrFail($item_id);

        return view('address_edit', compact('goods'));
    }

    public function updateForItem(Request $request, $item_id)
    {
        $validated = $request->validate([
            'post_code' => 'required|string|max:10',
            'address'   => 'required|string|max:255',
            'building'  => 'nullable|string|max:255',
        ]);

        Address::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'post_code' => $validated['post_code'],
                'address'   => $validated['address'],
                'building'  => $validated['building'],
            ]
        );

        return redirect()->route('purchase.confirm', ['item_id' => $item_id]);
    }

}
