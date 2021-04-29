<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\SurveyTemplate;
use Illuminate\Http\Request;

class SurveyTemplateApi extends Controller
{
    public function getTemplateQuestions($template_id){
        $template = SurveyTemplate::find($template_id);
        $questions = json_decode($template->questions,true);
        return ['template'=>$template,'questions'=>$questions];
    }
}
