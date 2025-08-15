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

        $user->update([
            'name' => $request->input('name'),
        ]);

        $path = $user->address->profile_image ?? null;
        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
        }

        $user->address()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'post_code' => $request->input('post_code'),
                'address' => $request->input('address'),
                'building' => $request->input('building'),
                'profile_image' => $path,
                'user_name' => $user->name,
            ]
        );


        return redirect('/mypage');
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
        $post_code = $request->input('post_code');
        $address   = $request->input('address');
        $building  = $request->input('building');

        session([
            'temp_address' => [
                'post_code' => $post_code,
                'address'   => $address,
                'building'  => $building,
                'user_name'  => Auth::user()->name,
            ]
        ]);

        return redirect()->route('purchase.confirm', ['item_id' => $item_id]);
    }
}
