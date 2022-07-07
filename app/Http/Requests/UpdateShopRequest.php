<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShopRequest extends FormRequest
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
            'title' => 'required|between:2,220',
            'address' => 'required|between:2,250',
            'schedule' => 'required|between:2,80',
            'phone_number' => 'required|between:11,11',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => 'наименование',
            'address' => 'адрес',
            'schedule' => 'график',
            'phone_number' => 'номер телефона',
        ];
    }
}
