<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryFormRequest extends FormRequest
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
            'product' => 'required|max:50|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ]+[\s]*)*/',
            'measure' => 'required',
            'quantity' => 'required|numeric|min:1',
            'idSucursal' => 'required',
        ];
    }

    public function messages(){
        return [
            'product.required' => 'El nombre del producto es obligatorio',
            'product.regex' => 'El formato del texto es invalido',
            'measure.required' => 'La medida del producto es obligatorio',
            'quantity.required' => 'La cantidad del producto es obligatoria',
            'idSucursal.required' => 'Especifique a que sucursal pertenece el producto',
            'quantity.min' => 'El numero es invalido',
            'max' => 'Se ha excedido el numero maximo de caracteres',
        ];
    }
}
