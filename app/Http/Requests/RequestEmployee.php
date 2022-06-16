<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestEmployee extends FormRequest
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
            'first_name' => 'required | max:45',
            'last_name' => 'required | max:45',
            'gender' => 'required | max:1',
            'status' => 'required | max:1',
            'payroll' => 'numeric | required',
            'group_code' => 'required',
            'hire_date' => 'date | required',
            'position_id' => 'required',
            'department_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => 'nombre',
            'last_name' => 'apellidos',
            'gender' => 'genero',
            'status' => 'estado',
            'payroll' => 'nómina',
            'group_code' => 'tipo de nómina',
            'hire_date' => 'fecha',
            'position_id' => 'puesto',
            'department_id' => 'departamento',

        ];
    }

    /*public function messages()
    {
        return[
            'last_name.required' => 'Error perzonalizado',
        ];
    }*/
}
