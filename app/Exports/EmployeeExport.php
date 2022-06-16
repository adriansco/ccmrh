<?php

namespace App\Exports;

use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        /* >> Cualquier consulta << */
        /* return Employee::all(); */
        return DB::table('employees')
            ->join('department_employee', 'employees.id', '=', 'department_employee.employee_id')
            ->join('departments', 'department_employee.department_id', '=', 'departments.id')
            ->select('employees.id', 'employees.first_name', 'employees.last_name', 'employees.gender', 'employees.status', 'employees.payroll', 'employees.hire_date', 'departments.name as dep_name')
            ->whereNull('department_employee.to_date')->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Apellido',
            'Genero',
            'Status',
            'N° nómina',
            'Fecha de contratación',
            'Departamento'
            /* ,
            'Precio',
            'Stock',
            'Descripcion',
            'Estado' */
        ];
    }
}
