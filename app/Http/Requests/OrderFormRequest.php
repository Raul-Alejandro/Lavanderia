<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderFormRequest extends FormRequest
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
            'customer' => 'required|regex:/^([a-zA-ZñÑáéíóúÁÉÍÓÚ]+[\s]*)*/',
            'phone' => 'numeric',
            'idSucursal' => 'required',
            'pay' => 'numeric|min:1',
            'hour' => 'max:8',
            'delivery_date' => 'required',
            'wash_service1' => 'numeric',
            'wash_quantity1' => 'required|min:1|integer',
            'wash_weight1' => 'required|numeric',
            'wash_service2' => 'numeric',
            'wash_quantity2' => 'required|min:1|integer',
            'wash_weight2' => 'required|numeric',
            'wash_service3' => 'numeric',
            'wash_quantity3' => 'required|min:1|integer',
            'wash_weight3' => 'required|numeric',
            'wash_service4' => 'numeric',
            'wash_quantity4' => 'required|min:1|integer',
            'wash_weight4' => 'required|numeric',
            'wash_service5' => 'numeric',
            'wash_quantity5' => 'required|min:1|integer',
            'wash_weight5' => 'required|numeric',
            'wash_service6' => 'numeric',
            'wash_quantity6' => 'required|min:1|integer',
            'wash_weight6' => 'required|numeric',
            'wash_service7' => 'numeric',
            'wash_quantity7' => 'required|min:1|integer',
            'wash_weight7' => 'required|numeric',
            'wash_service8' => 'numeric',
            'wash_quantity8' => 'required|min:1|integer',
            'wash_weight8' => 'required|numeric',
            'wash_service9' => 'numeric',
            'wash_quantity9' => 'required|min:1|integer',
            'wash_weight9' => 'required|numeric',
            'wash_service10' => 'numeric',
            'wash_quantity10' => 'required|min:1|integer',
            'wash_weight10' => 'required|numeric',
            'iron_service1' => 'numeric',
            'iron_quantity1' => 'required|min:1|integer',
            'iron_service2' => 'numeric',
            'iron_quantity2' => 'required|min:1|integer',
            'iron_service3' => 'numeric',
            'iron_quantity3' => 'required|min:1|integer',
            'iron_service4' => 'numeric',
            'iron_quantity4' => 'required|min:1|integer',
            'iron_service5' => 'numeric',
            'iron_quantity5' => 'required|min:1|integer',
            'iron_service6' => 'numeric',
            'iron_quantity6' => 'required|min:1|integer',
            'iron_service7' => 'numeric',
            'iron_quantity7' => 'required|min:1|integer',
            'iron_service8' => 'numeric',
            'iron_quantity8' => 'required|min:1|integer',
            'iron_service9' => 'numeric',
            'iron_quantity9' => 'required|min:1|integer',
            'iron_service10' => 'numeric',
            'iron_quantity10' => 'required|min:1|integer',
            'dry_service1' => 'numeric',
            'dry_quantity1' => 'required|min:1|integer',
            'dry_service2' => 'numeric',
            'dry_quantity2' => 'required|min:1|integer',
            'dry_service3' => 'numeric',
            'dry_quantity3' => 'required|min:1|integer',
            'dry_service4' => 'numeric',
            'dry_quantity4' => 'required|min:1|integer',
            'dry_service5' => 'numeric',
            'dry_quantity5' => 'required|min:1|integer',
            'dry_service6' => 'numeric',
            'dry_quantity6' => 'required|min:1|integer',
            'dry_service7' => 'numeric',
            'dry_quantity7' => 'required|min:1|integer',
            'dry_service8' => 'numeric',
            'dry_quantity8' => 'required|min:1|integer',
            'dry_service9' => 'numeric',
            'dry_quantity9' => 'required|min:1|integer',
            'dry_service10' => 'numeric',
            'dry_quantity10' => 'required|min:1|integer',
        ];
    }

    public function messages(){
        return [
            'customer.required' => 'El nombre del cliente es obligatorio',
            'customer.regex' => 'El formato del texto es invalido',
            'idSucursal.required' => 'Seleccione una de las sucursales',
            'delivery_date.required' => 'Ingrese la fecha de entrega',
            'phone.numeric' => 'Ingrese solamente numeros',
            'numeric' => 'Seleccione una de las opciones',
            'required' => 'Ingrese un valor',
            'min' => 'El valor debe ser mayor a 0',
            'max' => 'Se ha excedido el numero de caracteres',
            'integer' => 'El valor debe ser un numero entero',
        ];
    }
}
