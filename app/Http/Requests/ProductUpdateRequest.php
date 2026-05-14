<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'product_name' => 'required',
            'company_id' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'img_path' => 'nullable|image',
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => '商品名は必須です。',
            'company_id.required' => 'メーカー名は必須です。',
            'price.required' => '価格は必須です。',
            'stock.required' => '在庫数は必須です。',
            'img_path.image' => '画像ファイルを選択してください。',
        ];
    }
}