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
            'email' => ['required', 'string', 'email', 'email:dns', 'email:spoof', 'max:256', 'exists:users'],
            'password' => ['required', 'between:8,24', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', 'exists:users'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'メールアドレスを入力してください',
            'email.string' => '有効な形式で入力してください',
            'email.email' => '有効なメールアドレスをご利用ください',
            'email.max' => '256文字以下で入力してください',
            'email.exists' => '入力されたメールアドレスは登録されていません',

            'password.required' => 'パスワードを入力してください',
            'password.between' => '8文字以上24文字以下で入力してください',
            'password.regex' => 'a~z, A~Z, 0~9を最低一つずつ組み合わせて入力してください',
            'password.exists' => 'パスワードが一致しません',
        ];
    }
}
