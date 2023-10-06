<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBreedRequest extends FormRequest
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

    public function rules()
    {
        return [
            'id' => '',
            'title' => 'required|string',
            'average_age' => 'required|integer|min:1|max:100',
            'description' => '',
        ];
    }

    public function messages() 
    {
        return [
            'required' => 'Поле должно быть заполнено',
            'integer' => 'Введите целое число от 1 до 100',
            'min' => 'Введите целое число от 1 до 100',
            'max' => 'Введите целое число от 1 до 100',
        ];
    }
}
