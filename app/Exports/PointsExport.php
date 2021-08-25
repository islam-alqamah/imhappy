<?php

namespace App\Exports;

use App\Models\Point;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PointsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array {
        return [
            "Point ID","Branch ID","Point Name","Point Type","Point Title","Thank you Message"
        ];
    }
    public function collection()
    {
        return Point::where('team_id',currentTeam()->id)->get(['id','branch_id','name','type','title','text']);
    }
}
