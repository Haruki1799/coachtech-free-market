<?php

namespace App\Http\Controllers;
use App\Models\Goods;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function show($id)
    {
        $goods = Goods::findOrFail($id);
        return view('purchase', compact('goods'));
    }

    public function store(Request $request, $item_id)
    {
        $goods = Goods::findOrFail($item_id);

        return redirect()->route('mypage')->with('success', '購入が完了しました！');
    }

    public function confirm(Request $request, $item_id)
    {
        $goods = Goods::findOrFail($item_id);
        $address = $request->input('address');
        
        return view('purchase_confirm', compact('goods', 'address'));
    }
}
