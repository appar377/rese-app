<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255',
            'password' => 'required|between:8,255'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.max' => '255文字以内で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスの形式で入力してください',
            'email.max' => '255文字以内で入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.between' => '8文字以上~255文字以内で入力してください'
        ];
    }
}
