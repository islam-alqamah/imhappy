<?php

namespace App\Exports;

use App\Models\FeedbackResponse;
use Maatwebsite\Excel\Concerns\FromCollection;

class ResponsesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return FeedbackResponse::all();
    }
}
