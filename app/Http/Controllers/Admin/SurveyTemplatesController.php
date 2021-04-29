<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\SurveyTemplate;
use App\Models\Team;
use Illuminate\Http\Request;

class SurveyTemplatesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index($template = null){
        $templates = SurveyTemplate::all();
        if(isset($template))
            $template = SurveyTemplate::find($template);
        return view('admin.survey-templates',compact('templates','template'));
    }
    public function save_template(Request $request,$template = 0){
        if($template){
            $template = SurveyTemplate::find($template);
        }else{
            $template = new SurveyTemplate();
        }
        $template->name = $request->name;
        $template->title = $request->title;
        $questions = [];
        foreach ($request->question as $key=>$question){
            $questions[$question] = $request->answers[$key];
        }
        $template->questions = json_encode($questions);
        $template->save();
        return back()->with(['status'=>'success','msg'=>'Data Saved']);
    }
    public function delete($template){
        SurveyTemplate::find($template)->delete();
        return back()->with(['status'=>'success','msg'=>'Data Saved']);
    }
}
