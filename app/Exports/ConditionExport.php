<?php

namespace App\Exports;

use App\Models\Condition;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ConditionExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Condition::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'Nombre',
        ];
    }
}
