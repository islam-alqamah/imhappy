<?php

namespace App\Http\Controllers;

use App\Models\FeedbackForm;
use App\Models\FeedbackResponse;
use App\Models\Point;
use App\Models\QuestionAnswer as SurveyAnswer;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{

    public function index(){
        return view('layouts/landing/home');
    }
    public function view($point){
        $point = Point::find($point);
        if($point->type == 'feedback'){
            return view('feedback',compact('point'));
        }else{
            return view('survey',compact('point'));
        }

    }

    public function feedback(Request $request,$form_id){
        $form = FeedbackForm::find($form_id);
        $team = $form->point->team;
        //dd($team->settings->response_time_delay);
        $hourly_check = FeedbackResponse::where('user_ip',$request->ip())->
        where('form_id',$form_id)->where('created_at', '>',
            Carbon::now()->subMinutes($team->settings->response_time_delay)->toDateTimeString()
        )->get();
        if(!$hourly_check->count()) {

            $feedback = new FeedbackResponse();
            $feedback->form_id = $form->id;
            $feedback->team_id = $form->point->team_id;
            $feedback->city_id = $form->point->branch->city->id;
            $feedback->branch_id = $form->point->branch->id;
            $feedback->user_ip = $request->ip();
            $feedback->email = $request->email;
            $feedback->phone = $request->phone;
            $feedback->feedback = $request->feedback;
            $feedback->rate = $request->rate;
            $feedback->save();

            $rates = [
                'excellent' => json_decode('"\ud83d\ude03"'),
                'average' => json_decode('"\ud83d\ude10"'),
                'verypoor' => json_decode('"\ud83d\ude21"'),
            ];
            $date_time = 'Date: ' . date('d-m-Y') . ' ' . 'Time: ' . date('H:i') . '%0A';
            $branch_name = 'Branch: ' . $form->point->branch->name . '%0A';
            $ip = 'IP: ' . $request->ip() . '%0A';
            $phone_email = 'Phone Email: ' . $request->phone . ' ' . $request->email . '%0A';
            $message = 'Rate: ' . $rates[$request->rate] . '%0A';
            $message .= 'Feedback Msg: ' . $request->feedback . '%0A';
            //Send telegram message//
            $handled_message = urlencode($date_time . $branch_name . $ip . $phone_email . $message);
            if ($request->feedback != '') {
                $curl = curl_init();
                $team = $form->point->team;
                $groupid = $team->settings->telegram;
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.jalmood.org/telegram/" . $groupid . "/" . $handled_message,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "cache-control: no-cache"
                    ),
                ));
                $curl_response = curl_exec($curl);
            }
        }
        return redirect()->route('feedback.thanks',['form'=>$form]);
    }
    public function survey(Request $request,$form){
        foreach ($request->answer as $question_id=>$answer){
            $hourly_check = SurveyAnswer::where('question_id',$question_id)
                ->where('user_ip',$request->ip())->where('created_at', '>',
                    Carbon::now()->subHours(1)->toDateTimeString()
                )->get();
//            if(!$hourly_check->count()){
                $surveyAnswer = new SurveyAnswer();
                $surveyAnswer->question_id = $question_id;
                $surveyAnswer->answer = $answer;
                $surveyAnswer->user_ip = $request->ip();
                $surveyAnswer->save();
//            }

        }
        return redirect()->route('feedback.thanks',['form'=>$form]);
    }
    public function thanks($form){
        $point = FeedbackForm::find($form)->point;
        return view('thanks',compact('point'));
    }



}
