<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = ['name','city_id','team_id','address','phone'];
    use HasFactory;
    public function city(){
        return $this->belongsTo(City::class);
    }

    public function points(){
        return $this->hasMany(Point::class);
    }
    public function forms(){
        return $this->hasManyThrough(FeedbackForm::class,Point::class);
    }
}
