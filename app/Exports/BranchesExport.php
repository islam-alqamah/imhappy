<?php

namespace App\Exports;

use App\Models\Branch;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BranchesExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array {
        return [
            "Branch ID","Branch Name","Branch Phone","Branch Address"
        ];
    }
    public function collection()
    {
        return Branch::where('team_id',currentTeam()->id)->get(['id','name','phone','address']);
    }
}
