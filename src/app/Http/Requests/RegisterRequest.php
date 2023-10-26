<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'email:dns', 'email:spoof', 'max:256', 'unique:users'],
            'password' => ['required', 'between:8,24', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
            'icon' => ['file', 'image', 'max:10240']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.string' => '有効な形式で入力してください',
            'name.max' => '20文字以下で入力してください',

            'email.required' => 'メールアドレスを入力してください',
            'email.string' => '有効な形式で入力してください',
            'email.email' => '有効なメールアドレスをご利用ください',
            'email.max' => '256文字以下で入力してください',
            'email.unique' => 'そのメールアドレスは使用されています',

            'password.required' => 'パスワードを入力してください',
            'password.between' => '8文字以上24文字以下で入力してください',
            'password.regex' => 'a~z, A~Z, 0~9を最低一つずつ組み合わせて入力してください',

            'icon.file' => 'ファイルのアップロードに失敗しました',
            'icon.image' => '画像ファイルでお願いします',
            'icon.max' => 'ファイルのサイズは10MB以下でお願いします',
        ];
    }
}
