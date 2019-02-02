<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromotionFormRequest extends FormRequest
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
            'name' => 'required|max:50|regex:/^([a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ]+[\s]*)*/',
            'description' => 'required|max:1000',
            'wash_service1' => 'numeric',
            'wash_quantity1' => 'required|min:1|integer',
            'wash_type1' => 'numeric',
            'wash_service2' => 'numeric',
            'wash_quantity2' => 'required|min:1|integer',
            'wash_type2' => 'numeric',
            'wash_service3' => 'numeric',
            'wash_quantity3' => 'required|min:1|integer',
            'wash_type3' => 'numeric',
            'wash_service4' => 'numeric',
            'wash_quantity4' => 'required|min:1|integer',
            'wash_type4' => 'numeric',
            'wash_service5' => 'numeric',
            'wash_quantity5' => 'required|min:1|integer',
            'wash_type5' => 'numeric',
            'wash_service6' => 'numeric',
            'wash_quantity6' => 'required|min:1|integer',
            'wash_type6' => 'numeric',
            'wash_service7' => 'numeric',
            'wash_quantity7' => 'required|min:1|integer',
            'wash_type7' => 'numeric',
            'wash_service8' => 'numeric',
            'wash_quantity8' => 'required|min:1|integer',
            'wash_type8' => 'numeric',
            'wash_service9' => 'numeric',
            'wash_quantity9' => 'required|min:1|integer',
            'wash_type9' => 'numeric',
            'wash_service10' => 'numeric',
            'wash_quantity10' => 'required|min:1|integer',
            'wash_type10' => 'numeric',
            'iron_service1' => 'numeric',
            'iron_quantity1' => 'required|min:1|integer',
            'iron_type1' => 'numeric',
            'iron_service2' => 'numeric',
            'iron_quantity2' => 'required|min:1|integer',
            'iron_type2' => 'numeric',
            'iron_service3' => 'numeric',
            'iron_quantity3' => 'required|min:1|integer',
            'iron_type3' => 'numeric',
            'iron_service4' => 'numeric',
            'iron_quantity4' => 'required|min:1|integer',
            'iron_type4' => 'numeric',
            'iron_service5' => 'numeric',
            'iron_quantity5' => 'required|min:1|integer',
            'iron_type5' => 'numeric',
            'iron_service6' => 'numeric',
            'iron_quantity6' => 'required|min:1|integer',
            'iron_type6' => 'numeric',
            'iron_service7' => 'numeric',
            'iron_quantity7' => 'required|min:1|integer',
            'iron_type7' => 'numeric',
            'iron_service8' => 'numeric',
            'iron_quantity8' => 'required|min:1|integer',
            'iron_type8' => 'numeric',
            'iron_service9' => 'numeric',
            'iron_quantity9' => 'required|min:1|integer',
            'iron_type9' => 'numeric',
            'iron_service10' => 'numeric',
            'iron_quantity10' => 'required|min:1|integer',
            'iron_type10' => 'numeric',
            'dry_service1' => 'numeric',
            'dry_quantity1' => 'required|min:1|integer',
            'dry_type1' => 'numeric',
            'dry_service2' => 'numeric',
            'dry_quantity2' => 'required|min:1|integer',
            'dry_type2' => 'numeric',
            'dry_service3' => 'numeric',
            'dry_quantity3' => 'required|min:1|integer',
            'dry_type3' => 'numeric',
            'dry_service4' => 'numeric',
            'dry_quantity4' => 'required|min:1|integer',
            'dry_type4' => 'numeric',
            'dry_service5' => 'numeric',
            'dry_quantity5' => 'required|min:1|integer',
            'dry_type5' => 'numeric',
            'dry_service6' => 'numeric',
            'dry_quantity6' => 'required|min:1|integer',
            'dry_type6' => 'numeric',
            'dry_service7' => 'numeric',
            'dry_quantity7' => 'required|min:1|integer',
            'dry_type7' => 'numeric',
            'dry_service8' => 'numeric',
            'dry_quantity8' => 'required|min:1|integer',
            'dry_type8' => 'numeric',
            'dry_service9' => 'numeric',
            'dry_quantity9' => 'required|min:1|integer',
            'dry_type9' => 'numeric',
            'dry_service10' => 'numeric',
            'dry_quantity10' => 'required|min:1|integer',
            'dry_type10' => 'numeric',
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Escriba un nombre para la promocion',
            'description.required' => 'Escriba una breve descripcion',
            'max' => 'Se excedio el maximo de caracteres',
            'numeric' => 'Seleccione una de las opciones',
            'required' => 'Ingrese un valor',
            'min' => 'El valor debe ser mayor a 0',
            'integer' => 'El valor debe ser un numero entero',
            'regex' => 'El formato del texto es invalido',
        ];
    }
}
