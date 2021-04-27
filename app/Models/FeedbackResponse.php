<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackResponse extends Model
{
    use HasFactory;
    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function form(){
        return $this->belongsTo(FeedbackForm::class);
    }
}
