<?php

namespace App\Http\Controllers;
use App\Models\Goods;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;

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

    public function store(PurchaseRequest $request, $item_id)
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

        $temp = session('temp_address');

        if ($temp) {
            Address::updateOrCreate(
                ['user_id' => auth()->id()],
                $temp
            );
        }

        session()->forget('temp_address');

        return redirect()->route('home');
    }
}
