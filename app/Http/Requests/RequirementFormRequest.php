<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequirementFormRequest extends FormRequest
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
            '1wash_service1' => 'required|numeric',
            '1wash_quantity1' => 'numeric|min:1|integer',
            '1wash_weight1' => 'numeric',
            '1wash_service2' => 'required|numeric',
            '1wash_quantity2' => 'numeric|min:1|integer',
            '1wash_weight2' => 'numeric',
            '1wash_service3' => 'required|numeric',
            '1wash_quantity3' => 'numeric|min:1|integer',
            '1wash_weight3' => 'numeric',
            '1wash_service4' => 'required|numeric',
            '1wash_quantity4' => 'numeric|min:1|integer',
            '1wash_weight4' => 'numeric',
            '1wash_service5' => 'required|numeric',
            '1wash_quantity5' => 'numeric|min:1|integer',
            '1wash_weight5' => 'numeric',
            '1wash_service6' => 'required|numeric',
            '1wash_quantity6' => 'numeric|min:1|integer',
            '1wash_weight6' => 'numeric',
            '1wash_service7' => 'required|numeric',
            '1wash_quantity7' => 'numeric|min:1|integer',
            '1wash_weight7' => 'numeric',
            '1wash_service8' => 'required|numeric',
            '1wash_quantity8' => 'numeric|min:1|integer',
            '1wash_weight8' => 'numeric',
            '1wash_service9' => 'required|numeric',
            '1wash_quantity9' => 'numeric|min:1|integer',
            '1wash_weight9' => 'numeric',
            '1wash_service10' => 'required|numeric',
            '1wash_quantity10' => 'numeric|min:1|integer',
            '1wash_weight10' => 'numeric',
            '1iron_service1' => 'required|numeric',
            '1iron_quantity1' => 'numeric|min:1|integer',
            '1iron_service2' => 'required|numeric',
            '1iron_quantity2' => 'numeric|min:1|integer',
            'iiron_service3' => 'required|numeric',
            'iron_quantity3' => 'numeric|min:1|integer',
            '1iron_service4' => 'required|numeric',
            '1iron_quantity4' => 'numeric|min:1|integer',
            '1iron_service5' => 'required|numeric',
            '1iron_quantity5' => 'numeric|min:1|integer',
            '1iron_service6' => 'required|numeric',
            '1iron_quantity6' => 'numeric|min:1|integer',
            '1iron_service7' => 'required|numeric',
            '1iron_quantity7' => 'numeric|min:1|integer',
            '1iron_service8' => 'required|numeric',
            '1iron_quantity8' => 'numeric|min:1|integer',
            '1iron_service9' => 'required|numeric',
            '1iron_quantity9' => 'numeric|min:1|integer',
            '1iron_service10' => 'required|numeric',
            '1iron_quantity10' => 'numeric|min:1|integer',
            '1dry_service1' => 'required|numeric',
            '1dry_quantity1' => 'numeric|min:1|integer',
            '1dry_service2' => 'required|numeric',
            '1dry_quantity2' => 'numeric|min:1|integer',
            '1dry_service3' => 'required|numeric',
            '1dry_quantity3' => 'numeric|min:1|integer',
            '1dry_service4' => 'required|numeric',
            '1dry_quantity4' => 'numeric|min:1|integer',
            '1dry_service5' => 'required|numeric',
            '1dry_quantity5' => 'numeric|min:1|integer',
            '1dry_service6' => 'required|numeric',
            '1dry_quantity6' => 'numeric|min:1|integer',
            '1dry_service7' => 'required|numeric',
            '1dry_quantity7' => 'numeric|min:1|integer',
            '1dry_service8' => 'required|numeric',
            '1dry_quantity8' => 'numeric|min:1|integer',
            '1dry_service9' => 'required|numeric',
            '1dry_quantity9' => 'numeric|min:1|integer',
            '1dry_service10' => 'required|numeric',
            '1dry_quantity10' => 'numeric|min:1|integer',
        ];
    }

    public function messages(){
        return [
            'numeric' => 'Ingrese solamente numeros',
            'min' => 'El valor minimo es de 1',
            'integer' => 'El valor debe ser un numero entero',
        ];
    }
}
