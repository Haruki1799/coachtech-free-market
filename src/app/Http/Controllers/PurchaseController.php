<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use App\Models\Good;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;

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

        $stripe = new StripeClient(config('services.stripe.secret'));

        $session = $stripe->checkout->sessions->create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'unit_amount' => $good->price * 100,
                    'product_data' => [
                        'name' => $good->item,
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('purchase.success', ['item_id' => $item_id]),
            'cancel_url' => route('purchase.cancel'),
            'metadata' => [
                'user_id' => $user->id,
                'goods_id' => $good->id,
                'payment_method' => $request->payment,
                'post_code' => $validated['post_code'],
                'address' => $validated['address'],
                'building' => $validated['building'] ?? '',
            ],
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

        return redirect($session->url);
    }
    public function success(Request $request)
    {
        return view('purchase.success');
    }
    public function cancel()
    {
        return view('purchase.cancel');
    }

}