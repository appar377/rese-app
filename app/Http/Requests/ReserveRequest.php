<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveRequest extends FormRequest
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
            'date' => 'required|date_format:"Y-m-d"|after:today',
            'time' => 'required|date_format:"H:i"',
            'number' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'date.required' =>'日付を入力してください',
            'date.after' => '今日以降の日付を入力してください',
            'time.required' => '時間を入力してください',
        ];
    }
}
