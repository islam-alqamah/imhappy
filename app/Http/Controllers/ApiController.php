<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\QuestionAnswer;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function questions($point){
        $questions = Point::find($point)->form->questions;
        return $questions;
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
