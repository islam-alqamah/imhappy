<?php

namespace App\Exports;

use App\Models\FeedbackResponse;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResponsesExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array {
        return [
            "Branch ID","Point ID","Email","Phone","Feedback","Rate"
        ];
    }
    public function collection()
    {
        return FeedbackResponse::where('team_id',currentTeam()->id)->get(['branch_id','form_id','email','phone','feedback','rate']);
    }
}
