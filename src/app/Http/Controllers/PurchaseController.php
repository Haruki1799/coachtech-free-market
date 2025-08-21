<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;

class PurchaseController extends Controller
{
    public function show($id)
    {
        $good = Good::with('likes')->findOrFail($id);
        return view('purchase', compact('good'));
    }

    public function confirm($item_id)
    {
        $good = Good::findOrFail($item_id);
        $address = session('temp_address') ?? Auth::user()->address;

        return redirect()->route('purchase.complete');
    }

    public function store(PurchaseRequest $request, $item_id)
    {
        $good = Good::findOrFail($item_id);
        $user = Auth::user();

        if (!$user->address) {
            return back()->withErrors(['address' => '住所が登録されていません']);
        }

        $validated = $request->validated();

        Address::updateOrCreate(
            ['user_id' => $user->id],
            [
                'post_code' => $validated['post_code'],
                'address' => $validated['address'],
                'building' => $validated['building'] ?? null,
            ]
        );

        Order::create([
            'user_id' => $user->id,
            'goods_id' => $good->id,
            'payment_method' => $request->payment,
            'post_code' => $user->address->post_code,
            'address' => $user->address->address,
            'building' => $user->address->building,
        ]);

        $good->is_sold = true;
        $good->save();

        if ($temp = session('temp_address')) {
            Address::updateOrCreate(
                ['user_id' => $user->id],
                $temp
            );
        }

        session()->forget('temp_address');

        return redirect()->route('home');
    }
}