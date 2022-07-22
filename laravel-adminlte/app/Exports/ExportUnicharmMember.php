<?php

namespace App\Exports;

use App\Models\UnicharmMember;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportUnicharmMember implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UnicharmMember::all();
    }
}
