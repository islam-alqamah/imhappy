<?php

namespace App\Http\Controllers\Account;

use App\Exports\BranchesExport;
use App\Exports\PointsExport;
use App\Exports\ResponsesExport;
use App\Http\Controllers\Controller;
use App\Imports\BranchesImport;
use App\Imports\PointsImport;
use App\Imports\ResponsesImport;
use App\Models\Branch;
use App\Models\City;
use App\Models\FeedbackResponse;
use App\Models\FormQuestion;
use App\Models\Point;
use App\Models\QuestionAnswer;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use LaravelQRCode\Facades\QRCode;
use Maatwebsite\Excel\Facades\Excel;

class BranchesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(){
        $cities = Team::find(currentTeam()->id)->cities;
        $branches = Team::find(currentTeam()->id)->branches;
        return view('account.branches',compact('cities','branches'));
    }
    public function points($branch_id){
        $branch = Branch::find($branch_id);
        return view('account.points',compact('branch'));
    }

    public function responses(Request $request,$point){
        $point = Point::find($point);
        $responses = FeedbackResponse::where(function($query) use ($request,$point){
            if(isset($request->date_range)){
                $start_date = explode(' - ',$request->date_range)[0];
                $end_date = explode(' - ',$request->date_range)[1];
                $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
                $carbon_end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
                $query->whereBetween('created_at',[$carbon_start_date,$carbon_end_date])->get();
            }
            $query->where('form_id',$point->form->id);
        })->get();
        $questions = FormQuestion::where('form_id',$point->form->id)->get();

        $branch = $point->branch;
        if($point->type == 'feedback'){

            return view('account.responses',compact('request','responses','branch','point'));

        }else{
            return view('account.results',compact('request','questions','branch','point'));
        }
    }

    public function new_point(Request $request,$branch_id){
        $this->validate($request, [
            'name' => 'required|string|min:3',
        ]);
        $point = new Point();
        $point->team_id = currentTeam()->id;
        $point->branch_id = $branch_id;
        $point->name = $request->name;
        $point->title = $request->title;
        $point->text = $request->text;
        $point->type = $request->type;
        $point->qrcode = 'images/qr-codes/';
        $point->save();
        $url = url('view/point/'.$point->id);
        $pngpath = 'images/qr-codes/'.$point->id.'.png';
        QRCode::url($url)->setOutfile($pngpath)->setSize(15)->png();
        $point->qrcode = $pngpath;
        $point->save();

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

        return back()->with(['status'=>'success','msg'=>'Data Saved']);

    }

    public function all_points(){
        $points = Team::find(currentTeam()->id)->points;
        return view('account.allpoints',compact('points'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required|string|min:3',
        ]);
        if($request->city == 0){
            $city = new City();
            if($request->city_name == '')
                $request->city_name = 'Default City';

            $city->name = $request->city_name;
            $city->team_id = currentTeam()->id;
            $city->save();
            $request->city = $city->id;
        }
        $branch = new Branch();
        $branch->name = $request->name;
        $branch->city_id = $request->city;
        $branch->team_id = currentTeam()->id;
        $branch->phone = $request->phone;
        $branch->address = $request->address;
        $branch->longitude = $request->longitude;
        $branch->latitude = $request->latitude;
        $branch->save();
        return back()->with(['status'=>'success','msg'=>'Data Saved']);;
    }
    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required|string|min:3',
        ]);
        $branch = Branch::find($request->branch_id);
        $branch->name = $request->name;
        $branch->city_id = $request->city;
        $branch->team_id = currentTeam()->id;
        $branch->phone = $request->phone;
        $branch->address = $request->address;
        $branch->longitude = $request->longitude;
        $branch->latitude = $request->latitude;
        $branch->save();
        return back()->with(['status'=>'success','msg'=>'Data Saved']);
    }
    public function delete($branch){
        $branch = Branch::find($branch);
        foreach ($branch->points as $point){
            foreach ($point->form->responses as $response){
                FeedbackResponse::find($response->id)->delete();
            }
            foreach ($point->form->questions as $question){
                foreach ($question->qanswers as $answer){
                    QuestionAnswer::find($answer->id)->delete();
                }
                FormQuestion::find($question->id)->delete();
            }
            $point->delete();
        }
        $branch->delete();
        return back()->with(['status'=>'success','msg'=>'Data Saved']);
    }
    public function export_points(){
        return Excel::download(new PointsExport, 'Points.xlsx');
    }
    public function delete_point($point){
        $point = Point::find($point);
        foreach ($point->form->responses as $response){
            FeedbackResponse::find($response->id)->delete();
        }
        foreach ($point->form->questions as $question){
            foreach ($question->qanswers as $answer){
                QuestionAnswer::find($answer->id)->delete();
            }
            FormQuestion::find($question->id)->delete();
        }
        $point->delete();
        return back()->with(['status'=>'success','msg'=>'Data Saved']);
    }

    public function import_points(Request $request){
        Excel::import(new PointsImport,$request->file('file_to_import'));
        return back();
    }
    public function export_branches(){
        return Excel::download(new BranchesExport, 'branches-collection.xlsx');
    }
    public function import_branches(Request $request){
        Excel::import(new BranchesImport,$request->file('file_to_import'));
        return back();
    }
    public function export_responses(){
        return Excel::download(new ResponsesExport, 'Responses.xlsx');
    }
    public function import_responses(Request $request){
        if(Excel::import(new ResponsesImport,$request->file('file_to_import'))){
            return back()->with(['status'=>'success','msg'=>'Data Saved']);
        }else{
            return back()->with(['status'=>'danger','msg'=>'Check you xls file']);
        }

    }

}
