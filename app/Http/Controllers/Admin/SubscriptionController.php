<?php

namespace App\Http\Controllers\Admin;

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
        $subscriptions = Subscription::paginate(10);
        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    public function cancelSubscription(){
        $subscriptions = SubscriptionCancelation::paginate(10);
        return view('admin.subscriptions.cancel', compact('subscriptions'));
    }
}