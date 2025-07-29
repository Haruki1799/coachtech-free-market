<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function store(AddressRequest $request)
    {
        
        Address::create([
            'name' => $request['name'],
            'post_code' => $request['post_code'],
            'address' => $request['address'],
            'building' => $request['building'],
        ]);
        return redirect('/');
    }
}
