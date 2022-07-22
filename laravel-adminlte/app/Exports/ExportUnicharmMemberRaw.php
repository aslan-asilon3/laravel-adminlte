<?php

namespace App\Exports;

use App\Models\UnicharmMemberRaw;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportUnicharmMemberRaw implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UnicharmMemberRaw::all();
    }
}
