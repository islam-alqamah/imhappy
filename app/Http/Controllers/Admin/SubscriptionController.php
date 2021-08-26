<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use App\Models\subscribe;
use App\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Cashier\Subscription;
use App\Http\Controllers\Controller;
use App\Models\SubscriptionCancelation;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a specific permission permission to access these resources
    }

    public function subscription(){
        $subscriptions = subscribe::all();
        $plans = Plan::all();
        return view('admin.subscriptions.index', compact('plans','subscriptions'));
    }

    public function update(Request $request,$id){
        $subscribe = subscribe::find($id);
        $subscribe->ends_at = $request->ends_at;
        $subscribe->plan_id = $request->plan_id;
        $subscribe->updated_by = auth()->user()->name;
       $subscribe->save();
       return back();
    }

    public function cancelSubscription(){
        $subscriptions = SubscriptionCancelation::paginate(10);
        return view('admin.subscriptions.cancel', compact('subscriptions'));
    }
}