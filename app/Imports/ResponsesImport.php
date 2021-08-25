<?php

namespace App\Imports;

use App\Models\FeedbackForm;
use App\Models\FeedbackResponse;
use App\Models\Point;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ResponsesImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!empty($row['point_id'])){
            $feedback_form = Point::find($row['point_id'])->form;
            return new FeedbackResponse([
                'team_id'=>currentTeam()->id,
                'city_id'=>1,
                'branch_id'=>$row['branch_id'],
                'form_id'=>$feedback_form->id,
                'email'=>$row['email'],
                'phone'=>$row['phone'],
                'feedback'=>$row['feedback'],
                'rate'=>$row['rate']
            ]);
        }
    }
}
