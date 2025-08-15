<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment' => 'required|in:convenience,credit',
            'post_code' => 'required|string|max:10',
            'address'   => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'payment.required' => '支払い方法を選択してください',
            'payment.in' => '有効な支払い方法を選択してください',
            'post_code.required' => '郵便番号は必須です',
            'address.required' => '住所は必須です',
        ];
    }
}
