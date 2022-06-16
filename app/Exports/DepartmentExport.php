<?php

namespace App\Exports;

use App\Models\Department;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DepartmentExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Department::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Creado',
            'Modificado'
            /* ,
            'Precio',
            'Stock',
            'Descripcion',
            'Estado' */
        ];
    }
}
