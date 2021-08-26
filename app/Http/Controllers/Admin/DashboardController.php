<?php

namespace App\Http\Controllers\Admin;

use App\Models\Branch;
use App\Models\FeedbackResponse;
use App\Models\Payment;
use App\Models\Plan;
use Carbon\Carbon;
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
        $responses = FeedbackResponse::all()->count();
        $branches = Branch::all()->count();
        $revenue = Payment::where('status','success')->sum('amount');
        $newTicket = Ticket::where('status', 'Open')->count();
        $total_subscription = DB::table('subscriptions')->get()->count();
        $teams = Team::orderByDesc('created_at')->paginate(10);

        /** Users Chart **/
        $teamsChart = [];
        $carbon_start_date = Carbon::now();

        for($i = 0;$i<=30;$i++){
            $carbon_start_date = ($i == 0)? $carbon_start_date : $carbon_start_date->subDay();
            $teamsChart[$carbon_start_date->format('Y-m-d')] =
                Team::whereDate('created_at','<',
                    $carbon_start_date->addDay()->format('Y-m-d'))
                ->whereDate('created_at','>=',
                    $carbon_start_date->subDay()->format('Y-m-d'))->get()->count();
        }
        $teamsChart = array_reverse($teamsChart);

        $plans = Plan::where('active',1)->get();

        /** Users Chart**/
        return view('admin.index', compact('teams','plans','teamsChart','user_count','responses','branches','revenue','newTicket','total_subscription','team_count'));
    }
}