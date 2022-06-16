<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPetition extends FormRequest
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
            'id[]' => 'required',
            'group_code' => 'required',
            'position_destiny_id' => 'required',
            'department_destiny' => 'required',
            'category_id' => 'required',
            'start_date' => 'date | required',
            'end_date' => 'date | required',
        ];
    }
    public function attributes()
    {
        return [
            'id[]' => 'empleado',
            'group_code' => 'tipo de nómina',
            'position_destiny_id' => 'puesto origen',
            'department_destiny' => 'departamento destino',
            'category_id' => 'categoría',
            'start_date' => 'fecha inicio',
            'end_date' => 'fecha fin',
        ];
    }
}
