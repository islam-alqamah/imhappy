<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'stripe_id',
        'price',
        'active',
        'teams_limit',
        'trial_period_days',
        'interval',
    ];
    public function subscribes(){
        return $this->hasMany(subscribe::class);
    }
}
