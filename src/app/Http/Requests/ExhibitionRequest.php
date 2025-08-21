<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'item' => ['required', 'string', 'max:255'],
            'explanation' => ['required', 'string', 'max:255'],
            'image' => ['required', 'file', 'mimes:jpeg,png', 'max:2048'],
            'category_ids' => ['required', 'array', 'min:1'],
            'category_ids.*' => ['exists:categories,id'],
            'condition' => ['required', 'string'],
            'price' => ['required', 'integer', 'min:0'],
        ];
    }
    public function messages()
    {
        return [
            'item.required' => '商品名は必須です。',
            'explanation.required' => '商品説明は必須です。',
            'explanation.max' => '商品説明は255文字以内で入力してください。',
            'image.required' => '商品画像は必須です。',
            'image.mimes' => '画像は.jpegまたは.png形式でアップロードしてください。',
            'category_ids.required' => 'カテゴリーを1つ以上選択してください。',
            'category_ids.*.exists' => '選択されたカテゴリーが存在しません。',
            'condition.required' => '商品の状態を選択してください。',
            'price.required' => '価格は必須です。',
            'price.integer' => '価格は数値で入力してください。',
            'price.min' => '価格は0円以上で入力してください。',
        ];
    }
}
