<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolesFormRequest extends FormRequest
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
            'nombre_rol' => 'required|alpha',
        ];
    }

    public function messages()
    {
        return [
            'nombre_rol.required' => 'El campo nombre de rol es obligatorio',
            'nombre_rol.alpha'=>'El nombre solo puede contener letras',

        ];
    }
}
