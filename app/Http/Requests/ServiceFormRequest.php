<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceFormRequest extends FormRequest
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
            'code' => 'required|max:10|alpha_dash',
            'name' => 'required|max:50|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ]+[\s]*)*/',
            'measure' => 'required',
            'cost' => 'required|numeric|min:0',
            'promotion_cost' => 'nullable|numeric|min:0',
        ];
    }

    public function messages(){
        return [
            'code.required' => 'Ingrese un codigo para este servicio',
            'code.alpha_dash' => 'El codigo solo puede contener letras, numeros, guiones medios o guiones bajos',
            'name.required' => 'El nombre del servicio es obligatorio',
            'cost.required' => 'El costo del servicio es obligatorio',
            'measure.required' => 'Especifique la medida para el servicio',
            'max' => 'Se excedido el numero maximo de caracteres',
            'min' => 'Ingrese un valor numerico valido',
            'regex' => 'El formato del texto es invalido',
        ];
    }
}
