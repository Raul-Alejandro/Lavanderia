<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|alpha_dash',
            'type' => 'required',
            'idSucursal' => 'required',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'El Nombre del Usuario es Obligatorio',
            'name.regex' => 'El formato del texto es invalido',
            'email.required' => 'El email del Usuario es Obligatorio',
            'email.email' => 'Email no valido',
            'password.required' => 'Escriba una contraseña pàra el Usuario',
            'password.confirmed' => 'La contraseña no coincide',
            'type.required' => 'Seleccione una de las opciones',
            'idSucursal.required' => 'Defina a que sucursal pertenece el Usuario',
            'unique' => 'El campo :attribute ya ha sido registrado',
            'password.alpha_dash' => 'La contraseña solo puede contener letras, numeros, guiones medios o guiones bajos',
        ];
    }
}
