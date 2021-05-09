<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\QuestionAnswer;
use App\Models\Team;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function questions($point,Request $request){
        $team_id = Point::find($point)->team_id;
        if($request->company_id != "IMH00".$team_id){
            return ['status'=>'failed','msg'=>'company id invalid'];
        }
        $point = Point::find($point);
        if(!$point){
            return ['status'=>'failed','msg'=>'point id invalid'];
        }
        $questions = $point->form->questions;
        $color = $point->form->theme_color;
        $team = Team::find($team_id);
        $logo = $team->settings->logo;
        return ['point'=>$point,'logo'=>url($logo)];
    }
    public function postAnswer(Request $request){
        foreach ($request->answer as $question_id=>$answer){
            $row = new QuestionAnswer();
            $row->question_id = $question_id;
            $row->answer = $answer;
            $row->user_ip = $request->ip();
            $row->save();
        }
        $response = ['status'=>'success'];
        return $response;
    }
}
