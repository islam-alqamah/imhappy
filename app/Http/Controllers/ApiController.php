<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\QuestionAnswer;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function questions($point,Request $request){
        $team = Point::find($point)->team_id;
        if($request->company_id != "IMH00".$team){
            return ['status'=>'failed','msg'=>'company id invalid'];
        }
        $point = Point::find($point);
        if(!$point){
            return ['status'=>'failed','msg'=>'point id invalid'];
        }
        $questions = $point->form->questions;
        $color = $point->form->theme_color;
        return ['point'=>$point];
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
