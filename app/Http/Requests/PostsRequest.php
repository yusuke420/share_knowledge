<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'       => ['required', 'max:255'],                            // タイトル
            'importance'  => ['required'],                                       // 重要度
            'body'        => ['required'],                                       // 本文
            'image'       => ['nullable', 'max:1024', 'mimes:jpg,jpeg,png,gif'], // 画像
        ];
    }
}
