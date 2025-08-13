<?php

namespace App\Http\Controllers;
use App\Models\Goods;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function show($id)
    {
        $goods = Goods::findOrFail($id);
        return view('purchase', compact('goods'));
    }

    public function confirm(Request $request, $item_id)
    {
        $goods = Goods::findOrFail($item_id);
        $address = $request->input('address');
        
        return view('purchase_confirm', compact('goods', 'address'));
    }

    public function store(Request $request, $item_id)
    {

        $request->validate([
            'payment' => 'required|in:convenience,credit',
        ]);

        $goods = Goods::findOrFail($item_id);
        $user = Auth::user();

        if (!$user->address) {
            return back()->withErrors(['address' => '住所が登録されていません']);
        }

        Order::create([
            'user_id' => $user->id,
            'goods_id' => $goods->id,
            'payment_method' => $request->payment,
            'post_code' => $user->address->post_code,
            'address' => $user->address->address,
            'building' => $user->address->building,
        ]);


        $goods->is_sold = true;
        $goods->save();


        return redirect()->route('home');
    }
}
