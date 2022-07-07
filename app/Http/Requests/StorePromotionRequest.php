<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePromotionRequest extends FormRequest
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
            'description' => 'required|min:3',
            'image' => 'required|image|mimes:jpg,jpeg,png,bmp,gif|max:20000',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:today',
            'discount' => 'sometimes',
            'status' => 'sometimes|boolean',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'наименование',
            'description' => 'описание',
            'image' => 'изображение',
            'start_date' => 'дата начала',
            'end_date' => 'дата окончания',
            'status' => 'статус',
        ];
    }
}
