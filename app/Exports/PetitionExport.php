<?php

namespace App\Exports;

use App\Models\Petition;
use Maatwebsite\Excel\Concerns\FromCollection;

class PetitionExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Petition::all();
    }
}
