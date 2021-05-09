<?php

namespace App\Http\Controllers\Account;


use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\City;
use App\Models\FeedbackResponse;
use App\Models\FormQuestion;
use App\Models\Point;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class DashboardController extends Controller
{
    public function index(){
        $team = Team::find(currentTeam()->id);
        $forms = $team->forms;
        $responses = FeedbackResponse::whereIn('form_id',$forms->pluck('id')->toArray())->orderByDesc('created_at')->paginate(10);
        $allresponses = FeedbackResponse::whereIn('form_id',$forms->pluck('id')->toArray())->orderByDesc('created_at')->get();
        //*Excellent Data*//

        $total_responses = FeedbackResponse::whereIn('form_id',$forms->pluck('id')->toArray())
            ->where(function($query) {
                $query->where('created_at','<',
                    Carbon::now()->addDays(1)->format('Y-m-d'));
                    $query->where('created_at','>',
                        Carbon::now()->subDays(6)->format('Y-m-d'));
            })->count();

        $total_excellent = FeedbackResponse::where(function($query)  {
            $query->where('team_id', currentTeam()->id);
            $query->where('rate', 'excellent');
            if(isset($request->city_id) && $request->city_id != 'all')
                $query->where('city_id', $request->city_id);
            if(isset($request->branch_id) && $request->branch_id != 'all' ){
                $query->where('branch_id', $request->branch_id);
            }
            if(isset($request->date_range)){
                $start_date = explode(' - ',$request->date_range)[0];
                $end_date = explode(' - ',$request->date_range)[1];
                $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
                $carbon_end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
                $query->whereBetween('created_at',[$carbon_start_date,$carbon_end_date])->get();
            }
        })->get()->count();
        $excellent = [];
        $carbon_start_date = Carbon::now();

        for($i = 0;$i<=7;$i++){
            $carbon_start_date = ($i == 0)? $carbon_start_date : $carbon_start_date->subDay();
            $excellent[$carbon_start_date->format('Y-m-d')] = FeedbackResponse::where('rate','excellent')
                ->whereDate('created_at','<',
                    $carbon_start_date->addDay()->format('Y-m-d'))
                ->whereDate('created_at','>=',
                    $carbon_start_date->subDay()->format('Y-m-d'))

                ->where(function($query){
                    $query->where('team_id', currentTeam()->id);
                    if(isset($request->city_id) && $request->city_id != 'all')
                        $query->where('city_id', $request->city_id);
                    if(isset($request->branch_id) && $request->branch_id != 'all' ){
                        $query->where('branch_id', $request->branch_id);
                    }
                    if(isset($request->date_range)){
                        $start_date = explode(' - ',$request->date_range)[0];
                        $end_date = explode(' - ',$request->date_range)[1];
                        $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
                        $carbon_end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
                        $query->whereBetween('created_at',[$carbon_start_date,$carbon_end_date])->get();
                    }
                })->get();
        }
//*Excellent Data*//
        //*average Data*//
        $total_average = FeedbackResponse::where(function($query) {
            $query->where('team_id', currentTeam()->id);
            $query->where('rate', 'average');
            if(isset($request->city_id) && $request->city_id != 'all')
                $query->where('city_id', $request->city_id);
            if(isset($request->branch_id) && $request->branch_id != 'all' ){
                $query->where('branch_id', $request->branch_id);
            }
            if(isset($request->date_range)){
                $start_date = explode(' - ',$request->date_range)[0];
                $end_date = explode(' - ',$request->date_range)[1];
                $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
                $carbon_end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
                $query->whereBetween('created_at',[$carbon_start_date,$carbon_end_date])->get();
            }
        })->get()->count();

        $average = [];
        $carbon_start_date = Carbon::now();
        for($i = 0;$i<=7;$i++){
            $carbon_start_date = ($i == 0)? $carbon_start_date : $carbon_start_date->subDay();
            $average[$carbon_start_date->format('Y-m-d')] = FeedbackResponse::where('rate','average')
                ->whereDate('created_at','<',
                    $carbon_start_date->addDay()->format('Y-m-d'))
                ->whereDate('created_at','>=',
                    $carbon_start_date->subDay()->format('Y-m-d'))

                ->where(function($query) {
                    $query->where('team_id', currentTeam()->id);
                    if(isset($request->city_id) && $request->city_id != 'all')
                        $query->where('city_id', $request->city_id);
                    if(isset($request->branch_id) && $request->branch_id != 'all' ){
                        $query->where('branch_id', $request->branch_id);
                    }
                    if(isset($request->date_range)){
                        $start_date = explode(' - ',$request->date_range)[0];
                        $end_date = explode(' - ',$request->date_range)[1];
                        $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
                        $carbon_end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
                        $query->whereBetween('created_at',[$carbon_start_date,$carbon_end_date])->get();
                    }
                })->get();
        }
    //*Average Data*//
        //*Poor Data*//
        $total_poor = FeedbackResponse::where(function($query) {
            $query->where('team_id', currentTeam()->id);
            $query->where('rate', 'verypoor');
            if(isset($request->city_id) && $request->city_id != 'all')
                $query->where('city_id', $request->city_id);
            if(isset($request->branch_id) && $request->branch_id != 'all' ){
                $query->where('branch_id', $request->branch_id);
            }
            if(isset($request->date_range)){
                $start_date = explode(' - ',$request->date_range)[0];
                $end_date = explode(' - ',$request->date_range)[1];
                $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
                $carbon_end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
                $query->whereBetween('created_at',[$carbon_start_date,$carbon_end_date])->get();
            }
        })->get()->count();
        $poor = [];
        $carbon_start_date = Carbon::now();

        for($i = 0;$i<=7;$i++){
            $carbon_start_date = ($i == 0)? $carbon_start_date : $carbon_start_date->subDay();
            $poor[$carbon_start_date->format('Y-m-d')] = FeedbackResponse::where('rate','verypoor')
                ->whereDate('created_at','<',
                    $carbon_start_date->addDay()->format('Y-m-d'))
                ->whereDate('created_at','>=',
                    $carbon_start_date->subDay()->format('Y-m-d'))

                ->where(function($query){
                    $query->where('team_id', currentTeam()->id);
                    if(isset($request->city_id) && $request->city_id != 'all')
                        $query->where('city_id', $request->city_id);
                    if(isset($request->branch_id) && $request->branch_id != 'all' ){
                        $query->where('branch_id', $request->branch_id);
                    }
                    if(isset($request->date_range)){
                        $start_date = explode(' - ',$request->date_range)[0];
                        $end_date = explode(' - ',$request->date_range)[1];
                        $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
                        $carbon_end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
                        $query->whereBetween('created_at',[$carbon_start_date,$carbon_end_date])->get();
                    }
                })->get();
        }
        //*Poor Data*//
        $excellent = array_reverse($excellent);


        return view('dashboard',compact('team','total_average','total_excellent',
            'total_poor','allresponses','total_responses','responses','forms','excellent','average','poor'));
    }

    public function reports(Request $request){
        $team = Team::find(currentTeam()->id);
        $forms = $team->forms;
        $cities = $team->cities;
        $branches = $team->branches;
        $points = $team->points;
        if(isset($request->city_id) && $request->city_id!='all'){
            $branches = City::find($request->city_id)->branches;
        }
        if(isset($request->branch_id) && $request->branch_id!='all'){
            $points = Branch::find($request->branch_id)->points;
        }
        $responses = FeedbackResponse::where(function($query) use($request) {
            $query->where('team_id', currentTeam()->id);
            if(isset($request->city_id) && $request->city_id != 'all')
                $query->where('city_id', $request->city_id);
            if(isset($request->branch_id) && $request->branch_id != 'all' ){
                $query->where('branch_id', $request->branch_id);
            }
            if(isset($request->point_id) && $request->point_id != 'all' ){
                $form = Point::find($request->point_id)->form;
                $query->where('form_id', $form->id);
            }
            if(isset($request->date_range)){
                $start_date = explode(' - ',$request->date_range)[0];
                $end_date = explode(' - ',$request->date_range)[1];
                $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
                $carbon_end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
                $query->whereBetween('created_at',[$carbon_start_date,$carbon_end_date])->get();
            }
        })->get();
        if(isset($request->point_id) && $request->point_id != 'all' ){
            $point = Point::find($request->point_id);
            $questions = FormQuestion::where('form_id',$point->form->id)->get();

            $branch = $point->branch;
            if($point->type == 'survey') {
                return view('touchless-report', compact('team','cities','branches','points','request', 'questions', 'branch', 'point'));
            }
            else
            {
                return view('reports',compact('team','cities','branches','points','responses','request'));
            }
        }else{
            return view('reports',compact('team','cities','branches','points','responses','request'));
        }
    }
    public function charts(Request $request){


        $team = Team::find(currentTeam()->id);
        $cities = $team->cities;
        $branches = $team->branches;

        if(isset($request->city_id) && $request->city_id!='all'){
            $branches = City::find($request->city_id)->branches;
        }

        $total_responses = FeedbackResponse::where(function($query) use($request) {
            $query->where('team_id', currentTeam()->id);
            if(isset($request->city_id) && $request->city_id != 'all')
                $query->where('city_id', $request->city_id);
            if(isset($request->branch_id) && $request->branch_id != 'all' ){
                $query->where('branch_id', $request->branch_id);
            }
            if(isset($request->date_range)){
                $start_date = explode(' - ',$request->date_range)[0];
                $end_date = explode(' - ',$request->date_range)[1];
                $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
                $carbon_end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
                $query->whereBetween('created_at',[$carbon_start_date,$carbon_end_date])->get();
            }
        })->get()->count();


        //*Excellent Data*//

        $excellent = [];
        $carbon_start_date = Carbon::now();
        $carbon_init_date = Carbon::now();
        if(isset($request->date_range)){
            $start_date = explode(' - ',$request->date_range)[0];
            $end_date = explode(' - ',$request->date_range)[1];
            $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->addDays(30);
        }
        $agent = new Agent();
        $number_of_days = 30;
if($agent->isMobile()){
    $number_of_days = 30;
}
        for($i = 0;$i<=$number_of_days;$i++){
            $carbon_start_date = ($i == 0)? $carbon_init_date : $carbon_init_date->subDay();
            $excellent[$carbon_start_date->format('Y-m-d')] = FeedbackResponse::where('rate','excellent')
                ->whereDate('created_at','<',
                    $carbon_start_date->addDay()->format('Y-m-d'))
                ->whereDate('created_at','>=',
                    $carbon_start_date->subDay()->format('Y-m-d'))

                ->where(function($query) use ($request){
                    $query->where('team_id', currentTeam()->id);
                    if(isset($request->city_id) && $request->city_id != 'all')
                        $query->where('city_id', $request->city_id);
                    if(isset($request->branch_id) && $request->branch_id != 'all' ){
                        $query->where('branch_id', $request->branch_id);
                    }

                })->get();
        }

        $excellent_h = [];
        for($i = 0;$i<=23;$i++){
            $carbon_start_time = Carbon::createFromFormat('H', $i);
            $excellent_h[$carbon_start_time->format('h a')] = FeedbackResponse::where('rate','excellent')
                    ->whereTime('created_at','<=',
                    $carbon_start_time->addHour()->format('H:i:s'))
                ->whereTime('created_at','>=',
                    $carbon_start_time->subHour()->format('H:i:s'))

                ->where(function($query) use ($request){
                    $query->where('team_id', currentTeam()->id);
                    if(isset($request->city_id) && $request->city_id != 'all')
                        $query->where('city_id', $request->city_id);
                    if(isset($request->branch_id) && $request->branch_id != 'all' ){
                        $query->where('branch_id', $request->branch_id);
                    }
                    if(isset($request->date_range)){
                        $start_date = explode(' - ',$request->date_range)[0];
                        $end_date = explode(' - ',$request->date_range)[1];
                        $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
                        $carbon_end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
                        $query->whereBetween('created_at',[$carbon_start_date,$carbon_end_date])->get();
                    }
                })->get();
        }
        $excellent = array_reverse($excellent);
        /// End Hourly
        /// Month

        $excellent_m = FeedbackResponse::where('rate','excellent')
            ->where(function($query) use ($request){
                $query->where('team_id', currentTeam()->id);
                if(isset($request->city_id) && $request->city_id != 'all')
                    $query->where('city_id', $request->city_id);
                if(isset($request->branch_id) && $request->branch_id != 'all' ){
                    $query->where('branch_id', $request->branch_id);
                }
                if(isset($request->date_range)){
                    $start_date = explode(' - ',$request->date_range)[0];
                    $end_date = explode(' - ',$request->date_range)[1];
                    $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
                    $carbon_end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
                    $query->whereBetween('created_at',[$carbon_start_date,$carbon_end_date])->get();
                }
            })->get()->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('F');
            })->reverse();
        /// Daily

        $excellent_d = FeedbackResponse::where('rate','excellent')
            ->where(function($query) use ($request){
                $query->where('team_id', currentTeam()->id);
                if(isset($request->city_id) && $request->city_id != 'all')
                    $query->where('city_id', $request->city_id);
                if(isset($request->branch_id) && $request->branch_id != 'all' ){
                    $query->where('branch_id', $request->branch_id);
                }
                if(isset($request->date_range)){
                    $start_date = explode(' - ',$request->date_range)[0];
                    $end_date = explode(' - ',$request->date_range)[1];
                    $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
                    $carbon_end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
                    $query->whereBetween('created_at',[$carbon_start_date,$carbon_end_date])->get();
                }
            })->get()->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('l');
            });


//*Excellent Data*//
        //*average Data*//
        $average = [];
        $carbon_start_date = Carbon::now();
        if(isset($request->date_range)){
            $start_date = explode(' - ',$request->date_range)[0];
            $end_date = explode(' - ',$request->date_range)[1];
            $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->addDays(30);
        }
        for($i = 0;$i<=$number_of_days;$i++){
            $carbon_start_date = ($i == 0)? $carbon_init_date : $carbon_init_date->subDay();
            $average[$carbon_start_date->format('Y-m-d')] = FeedbackResponse::where('rate','average')
                ->whereDate('created_at','<',
                    $carbon_start_date->addDay()->format('Y-m-d'))
                ->whereDate('created_at','>=',
                    $carbon_start_date->subDay()->format('Y-m-d'))

                ->where(function($query) use ($request){
                    $query->where('team_id', currentTeam()->id);
                    if(isset($request->city_id) && $request->city_id != 'all')
                        $query->where('city_id', $request->city_id);
                    if(isset($request->branch_id) && $request->branch_id != 'all' ){
                        $query->where('branch_id', $request->branch_id);
                    }

                })->get();
        }

        $average_h = [];
        for($i = 0;$i<=23;$i++){
            $carbon_start_time = Carbon::createFromFormat('H', $i);
            $average_h[$carbon_start_time->format('h a')] = FeedbackResponse::where('rate','average')
                ->whereTime('created_at','<=',
                    $carbon_start_time->addHour()->format('H:i:s'))
                ->whereTime('created_at','>=',
                    $carbon_start_time->subHour()->format('H:i:s'))

                ->where(function($query) use ($request){
                    $query->where('team_id', currentTeam()->id);
                    if(isset($request->city_id) && $request->city_id != 'all')
                        $query->where('city_id', $request->city_id);
                    if(isset($request->branch_id) && $request->branch_id != 'all' ){
                        $query->where('branch_id', $request->branch_id);
                    }
                    if(isset($request->date_range)){
                        $start_date = explode(' - ',$request->date_range)[0];
                        $end_date = explode(' - ',$request->date_range)[1];
                        $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
                        $carbon_end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
                        $query->whereBetween('created_at',[$carbon_start_date,$carbon_end_date])->get();
                    }
                })->get();
        }

        /// End Hourly
        /// Month

        $average_m = FeedbackResponse::where('rate','average')
            ->where(function($query) use ($request){
                $query->where('team_id', currentTeam()->id);
                if(isset($request->city_id) && $request->city_id != 'all')
                    $query->where('city_id', $request->city_id);
                if(isset($request->branch_id) && $request->branch_id != 'all' ){
                    $query->where('branch_id', $request->branch_id);
                }
                if(isset($request->date_range)){
                    $start_date = explode(' - ',$request->date_range)[0];
                    $end_date = explode(' - ',$request->date_range)[1];
                    $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
                    $carbon_end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
                    $query->whereBetween('created_at',[$carbon_start_date,$carbon_end_date])->get();
                }
            })->get()->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('F');
            })->reverse();
        /// Daily

        $average_d = FeedbackResponse::where('rate','average')
            ->where(function($query) use ($request){
                $query->where('team_id', currentTeam()->id);
                if(isset($request->city_id) && $request->city_id != 'all')
                    $query->where('city_id', $request->city_id);
                if(isset($request->branch_id) && $request->branch_id != 'all' ){
                    $query->where('branch_id', $request->branch_id);
                }
                if(isset($request->date_range)){
                    $start_date = explode(' - ',$request->date_range)[0];
                    $end_date = explode(' - ',$request->date_range)[1];
                    $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
                    $carbon_end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
                    $query->whereBetween('created_at',[$carbon_start_date,$carbon_end_date])->get();
                }
            })->get()->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('l');
            });

        //*Average Data*//
        //*Poor Data*//

        $poor = [];
        $carbon_start_date = Carbon::now();
        if(isset($request->date_range)){
            $start_date = explode(' - ',$request->date_range)[0];
            $end_date = explode(' - ',$request->date_range)[1];
            $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->addDays(30);
        }
        for($i = 0;$i<=$number_of_days;$i++){
            $carbon_start_date = ($i == 0)? $carbon_init_date : $carbon_init_date->subDay();
            $poor[$carbon_start_date->format('Y-m-d')] = FeedbackResponse::where('rate','verypoor')
                ->whereDate('created_at','<',
                    $carbon_start_date->addDay()->format('Y-m-d'))
                ->whereDate('created_at','>=',
                    $carbon_start_date->subDay()->format('Y-m-d'))

                ->where(function($query) use ($request){
                    $query->where('team_id', currentTeam()->id);
                    if(isset($request->city_id) && $request->city_id != 'all')
                        $query->where('city_id', $request->city_id);
                    if(isset($request->branch_id) && $request->branch_id != 'all' ){
                        $query->where('branch_id', $request->branch_id);
                    }

                })->get();
        }

//        ////Hourly///
        $poor_h = [];
        for($i = 0;$i<=23;$i++){
            $carbon_start_time = Carbon::createFromFormat('H', $i);
            $poor_h[$carbon_start_time->format('h a')] = FeedbackResponse::where('rate','verypoor')
                ->whereTime('created_at','<=',
                    $carbon_start_time->addHour()->format('H:i:s'))
                ->whereTime('created_at','>=',
                    $carbon_start_time->subHour()->format('H:i:s'))

                ->where(function($query) use ($request){
                    $query->where('team_id', currentTeam()->id);
                    if(isset($request->city_id) && $request->city_id != 'all')
                        $query->where('city_id', $request->city_id);
                    if(isset($request->branch_id) && $request->branch_id != 'all' ){
                        $query->where('branch_id', $request->branch_id);
                    }
                    if(isset($request->date_range)){
                        $start_date = explode(' - ',$request->date_range)[0];
                        $end_date = explode(' - ',$request->date_range)[1];
                        $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
                        $carbon_end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
                        $query->whereBetween('created_at',[$carbon_start_date,$carbon_end_date])->get();
                    }
                })->get();
        }
//        for($i = 1;$i<23;$i++){
//            $poor_h[Carbon::now()->subHours($i+1)->format('h a')] = FeedbackResponse::where('rate','verypoor')
//                ->whereTime('created_at','<',
//                    Carbon::now()->subHours($i)->format('H:i:s'))
//                ->whereTime('created_at','>',
//                    Carbon::now()->subHours($i+1)->format('H:i:s'))
//
//                ->where(function($query) use ($request){
//                    $query->where('team_id', currentTeam()->id);
//                    if(isset($request->city_id) && $request->city_id != 'all')
//                        $query->where('city_id', $request->city_id);
//                    if(isset($request->branch_id) && $request->branch_id != 'all' ){
//                        $query->where('branch_id', $request->branch_id);
//                    }
//                    if(isset($request->date_range)){
//                        $start_date = explode(' - ',$request->date_range)[0];
//                        $end_date = explode(' - ',$request->date_range)[1];
//                        $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
//                        $carbon_end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
//                        $query->whereBetween('created_at',[$carbon_start_date,$carbon_end_date])->get();
//                    }
//                })->get();
//        }

        /// End Hourly
        ///
        /// Month

        $poor_m = FeedbackResponse::where('rate','verypoor')
            ->where(function($query) use ($request){
                $query->where('team_id', currentTeam()->id);
                if(isset($request->city_id) && $request->city_id != 'all')
                    $query->where('city_id', $request->city_id);
                if(isset($request->branch_id) && $request->branch_id != 'all' ){
                    $query->where('branch_id', $request->branch_id);
                }
                if(isset($request->date_range)){
                    $start_date = explode(' - ',$request->date_range)[0];
                    $end_date = explode(' - ',$request->date_range)[1];
                    $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
                    $carbon_end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
                    $query->whereBetween('created_at',[$carbon_start_date,$carbon_end_date])->get();
                }
            })->get()->groupBy(function($date) {
                return Carbon::parse($date->created_at)->format('F');
            })->reverse();

        /// Start Daily


            $poor_d = FeedbackResponse::where('rate','verypoor')
                ->where(function($query) use ($request){
                    $query->where('team_id', currentTeam()->id);
                    if(isset($request->city_id) && $request->city_id != 'all')
                        $query->where('city_id', $request->city_id);
                    if(isset($request->branch_id) && $request->branch_id != 'all' ){
                        $query->where('branch_id', $request->branch_id);
                    }
                    if(isset($request->date_range)){
                        $start_date = explode(' - ',$request->date_range)[0];
                        $end_date = explode(' - ',$request->date_range)[1];
                        $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
                        $carbon_end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
                        $query->whereBetween('created_at',[$carbon_start_date,$carbon_end_date])->get();
                    }
                })->get()->groupBy(function($date) {
                    return Carbon::parse($date->created_at)->format('l');
                });


        //*Poor Data*//
        return view('charts',compact('request','cities','branches','team',
            'total_responses','excellent','excellent_h','excellent_d','excellent_m',
            'average','average_h','average_d','average_m'
            ,'poor','poor_h','poor_d','poor_m'));

    }
}
