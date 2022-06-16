<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestUpdate extends FormRequest
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
            'hire_date' => 'date | required',
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
            'hire_date' => 'fecha',
        ];
    }
}
