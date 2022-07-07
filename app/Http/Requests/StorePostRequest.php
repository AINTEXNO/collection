<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required|between:3,250',
            'text' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,bmp,gif|max:20000',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'заголовок',
            'text' => 'описание',
            'image' => 'изображение'
        ];
    }
}
