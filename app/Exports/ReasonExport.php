<?php

namespace App\Exports;

use App\Models\Reason;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReasonExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Reason::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'Nombre',
        ];
    }
}
