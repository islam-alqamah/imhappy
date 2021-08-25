<?php

namespace App\Imports;

use App\Models\FeedbackForm;
use App\Models\Point;
use DB;
use LaravelQRCode\Facades\QRCode;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PointsImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $id=DB::select("SHOW TABLE STATUS LIKE 'points'");
        $next_id=$id[0]->Auto_increment;
        $url = url('view/point/'.$next_id);
        $pngpath = 'images/qr-codes/'.$next_id.'.png';
        QRCode::url($url)->setOutfile($pngpath)->setSize(15)->png();
        $feedback_form = new FeedbackForm;
        $feedback_form->point_id = $next_id;
        $feedback_form->theme_color = '#0098a3';
        $feedback_form->rate_label = $row['point_question'];
        $feedback_form->submit_text = 'Send Now';
        $feedback_form->fields = '{"email":"no","feedback":"no"}';
        $feedback_form->save();
        return new Point([
            'team_id' => currentTeam()->id,
            'branch_id' => $row['branch_id'],
            'name'=> $row['point_name'],
            'title'=> $row['point_title'],
            'text'=> $row['thank_you_message'],
            'type'=> $row['point_type'],
            'qrcode'=> $pngpath,
            ]);
    }
}
