<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Auth;

class UserEditFormRequest extends FormRequest
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
            'name' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ]+[\s]*)*/',
            'password' => 'confirmed',
            'type' => 'required',
            'status' => 'required',
            'idSucursal' => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'El Nombre del Usuario es Obligatorio',
            'name.regex' => 'El formato del texto es invalido',
            'password.confirmed' => 'La contraseña no coincide',
            'type.required' => 'Seleccione una de las opciones',
            'status.required' => 'Seleccione un status para el Usuario',
            'idSucursal.required' => 'Defina a que sucursal pertenece el Usuario',
            'unique' => 'El campo :attribute ya ha sido registrado',
        ];
    }
}
