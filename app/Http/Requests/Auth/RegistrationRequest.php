<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'name' => 'required|between:2,30',
            'surname' => 'required|between:3,30',
            'email' => 'email|required|between:5,40|unique:users',
            'password' => 'required|between:5,30|confirmed',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'имя',
            'surname' => 'фамилия',
            'email' => 'адрес электронной почты',
            'password' => 'пароль'
        ];
    }
}
