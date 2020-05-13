<?php

namespace App\Exports;

use App\Models\HouseOwner;
use Maatwebsite\Excel\Concerns\FromCollection;

class HouseOwnerExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HouseOwner::all();
    }
}
