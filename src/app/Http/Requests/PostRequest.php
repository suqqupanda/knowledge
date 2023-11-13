<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:60'],
            'post' => ['required', 'string', 'max:5000']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力してください',
            'title.string' => '有効な形式で入力してください',
            'title.max' => '60文字以下で入力してください',

            'post.required' => '本文を入力してください',
            'post.string' => '有効な形式で入力してください',
            'post.max' => '5000文字以下で入力してください',
        ];
    }
}
