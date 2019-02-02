<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ProfileRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
            'password' => 'confirmed',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'El Nombre del Usuario es Obligatorio',
            'name.regex' => 'El formato del texto es invalido',
            'email.required' => 'El email del Usuario es Obligatorio',
            'email.email' => 'Email no valido',
            'password.confirmed' => 'La contraseña no coincide',
            'unique' => 'El campo :attribute ya ha sido registrado',
        ];
    }
}
