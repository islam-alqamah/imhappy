<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    public function branch(){
        return $this->belongsTo(Branch::class);
    }

    public function form(){
        return $this->hasOne(FeedbackForm::class);
    }

    public function responses(){
        return $this->hasManyThrough(FeedbackResponse::class,FeedbackForm::class);
    }
    public function team(){
        return $this->belongsTo(Team::class,'team_id');
    }
}
