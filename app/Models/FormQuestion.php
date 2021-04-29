<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FormQuestion extends Model
{
    use HasFactory;

    public function qanswers(){
        return $this->hasMany(QuestionAnswer::class,'question_id');
    }
    public function answerscount(Request $request,$answer){
        return $this->hasMany(QuestionAnswer::class,'question_id')
            ->where('answer',$answer)->where(function($query) use ($request){

                if(isset($request->date_range)){
                    $start_date = explode(' - ',$request->date_range)[0];
                    $end_date = explode(' - ',$request->date_range)[1];
                    $carbon_start_date = Carbon::createFromFormat('m/d/Y', $start_date)->format('Y-m-d');
                    $carbon_end_date = Carbon::createFromFormat('m/d/Y', $end_date)->format('Y-m-d');
                    $query->whereBetween('created_at',[$carbon_start_date,$carbon_end_date])->get();
                }
            })->get();
    }
}
