<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FeedbackForm extends Model
{
    use HasFactory;

    public function point(){
        return $this->belongsTo(Point::class);
    }
    public function responses(){
        return $this->hasMany(FeedbackResponse::class,'form_id');
    }
    public function questions(){
        return $this->hasMany(FormQuestion::class ,'form_id');
    }
}
