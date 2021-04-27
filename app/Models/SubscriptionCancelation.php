<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionCancelation extends Model
{
    protected $guarded = [];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
