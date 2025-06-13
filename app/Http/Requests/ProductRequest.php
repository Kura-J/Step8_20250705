<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name' => 'required | max:255',
            'company_id' => 'required',
            'price' => 'required | integer',
            'stock' => 'required | integer',
            'comment' => 'max:10000',
        ];
    }

    public function attributes() {
        return [
            'product_name' => '商品名',
            'company_id' => 'メーカー',
            'price' => '金額',
            'stock' => '在庫',
        ];
    }

    public function messages() {
        return [
            'product_name.required' => ':attributeは必須項目です。',
            'company_id.required' => ':attributeは必須項目です。',
            'price.required' => ':attributesは必須項目です。',
            'price.integer' => ':attributesは数字で入力してください。',
            'stock.required' => ':attributesは必須項目です。',
            'stock.integer' => ':attributesは数字で入力してください。',
            'comment.max' => ':attributeは:max字以内で入力してください。',
        ];
    }
}
