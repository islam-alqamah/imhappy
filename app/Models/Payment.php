<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public function plan(){
        return $this->belongsTo(Plan::class);
    }
    public function subscribe(){
        return $this->hasOne(subscribe::class);
    }
}
