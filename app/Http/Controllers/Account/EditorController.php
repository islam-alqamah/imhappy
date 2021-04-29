<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\FeedbackForm;
use App\Models\FeedbackResponse;
use App\Models\FormQuestion;
use App\Models\Point;
use App\Models\SurveyTemplate;
use App\Models\TeamSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use LaravelQRCode\Facades\QRCode;

class EditorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index($branch,$point){
        if($point == 'new'){
            $point = null;
        }else{
            $point = Point::find($point);
        }
        $settings = TeamSetting::where('team_id',currentTeam()->id)->first();
        $branch = Branch::find($branch);
        $survey_templates = SurveyTemplate::all();
        return view('account.survey-editor',compact('branch','settings','point','survey_templates'));

    }
    public function update(Request $request,$branch,$point){


        if($request->type == 'survey'){
            $this->validate($request, [
                'question' => 'required|array',
            ]);
        }
        if($point != 'new'){
            $point = Point::find($point);
            $point->name = $request->name;
            $point->title = $request->title;
            $point->text = $request->text;
            $point->type = $request->type;
            $point->save();

        }else{
            $this->validate($request, [
                'name' => 'required|string|min:3',
            ]);
            $point = new Point();
            $point->team_id = currentTeam()->id;
            $point->branch_id = $branch;
            $point->name = $request->name;
            $point->title = $request->title;
            $point->text = $request->text;
            $point->type = $request->type;
            $point->qrcode = 'images/qr-codes/';
            $point->save();
            $url = url('view/point/'.$point->id);
            $pngpath = 'images/qr-codes/'.$point->id.'.png';
            QRCode::url($url)->setOutfile($pngpath)->setSize(30)->png();
            $point->qrcode = $pngpath;
            $point->save();
        }

        $form = FeedbackForm::where('point_id',$point->id)->first();
        if(!$form){
            $form = new FeedbackForm();
        }

        $form->point_id = $point->id;
        $form->theme_color = $request->theme_color;
        $form->rate_label = $request->rate_label;
        $form->submit_text = $request->submit_text;
        $form->save();
        if($point->type == 'feedback')
        {
            if($request->fields){
                $Fields = [];
                foreach ($request->fields as $field){
                    if(isset($request->required)&&in_array($field,$request->required)){
                        $Fields[$field] = 'yes';

                    }else{
                        $Fields[$field] = 'no';
                    }
                }
                $form->fields = json_encode($Fields);
            }
            $form->save();

            if(isset($request->dummy_data)){
                for($i = 1 ;$i<400 ;$i++){
                    $form = $point->form;
                    $feedback = new FeedbackResponse();
                    $feedback->form_id = $form->id;
                    $feedback->team_id = $form->point->team_id;
                    $feedback->city_id = $form->point->branch->city->id;
                    $feedback->branch_id = $form->point->branch->id;
                    $feedback->user_ip = $request->ip();
                    $feedback->email = 'user'.$i.'@example.com';
                    $feedback->phone = '55533'.$i;
                    $feedback->feedback = 'Feedback example'.$i;
                    $rates = ['excellent','average','verypoor'];
                    $feedback->rate = $rates[rand(0,2)];
                    $feedback->created_at = Carbon::today()->subDays(rand(3, $i))
                        ->subHours(rand(1, 23))->format('Y-m-d H:i:s');
                    $feedback->save();
                }
            }
        }else{

            $questions = FormQuestion::where('form_id',$form->id)->get();
            foreach ($questions as $question){
                $del = FormQuestion::find($question->id)->delete();
            }
            foreach ($request->question as $key=>$question){
                $row = new FormQuestion();
                $row->form_id = $form->id;
                $row->question = $question;
                $row->answers = $request->answers[$key];
                $row->save();
            }

        }

        return redirect()->route('branches.points.editor',['branch'=>$branch,'point'=>$point->id])->with(['status'=>'success','msg'=>'Data Saved']);
    }
}
