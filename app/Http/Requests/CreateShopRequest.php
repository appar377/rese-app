<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateShopRequest extends FormRequest
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
            'name' => 'required',
            'img' => 'required',
            'area_id' => 'required',
            'genre_id' => 'required',
            'content' => 'required',
            'course' => 'required',
            'price' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '店舗名を入力してください',
            'img.required' => '画像を選択してください',
            'area_id.required' => '地域を選択してください',
            'genre_id.required' => 'ジャンルを選択してください',
            'content.required' => '店舗紹介文を入力してください',
            'course.required' => 'コース名を入力してください',
            'price.required' => '価格を入力してください',
            'price.numeric' => '数値で入力してください',
        ];
    }
}
