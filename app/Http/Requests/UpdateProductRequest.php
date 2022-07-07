<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'category_id' => 'required|integer',
            'title' => 'required|string|between:5,140',
            'description' => 'required|string',
            'price' => 'required',
            'count' => 'required|integer',
            'collection_id' => 'sometimes|required|integer',
            'style_id' => 'sometimes|required|integer',
            'brand_id' => 'sometimes|required|integer',
            'color_id' => 'sometimes|required|integer',
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => 'категория',
            'title' => 'наименование',
            'description' => 'описание',
            'price' => 'стоимость',
            'count' => 'количество',
            'collection_id' => 'коллекция',
            'style_id' => 'стиль',
            'brand_id' => 'бренд',
            'color_id' => 'цвет',
        ];
    }
}
