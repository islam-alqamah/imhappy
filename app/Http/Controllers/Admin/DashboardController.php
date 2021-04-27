<?php

namespace App\Http\Controllers\Admin;

use Stripe;
use App\Models\Team;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $user_count = User::all()->count();
        $team_count = Team::all()->count();
        $newTicket = Ticket::where('status', 'Open')->count();  
        $total_subscription = DB::table('subscriptions')->get()->count();
        return view('admin.index', compact('user_count','newTicket','total_subscription','team_count'));
    }
}