<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\User;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Support\Facades\DB;

class UsersChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $today_users = User::whereDate('created_at', today())->count();
        $yesterday_users = User::whereDate('created_at', today()->subDays(1))->count();
        $users_2_days_ago = User::whereDate('created_at', today()->subDays(2))->count();
        // Billing
        $today_billings = DB::table('subscriptions')->whereDate('created_at', today())->count();
        $yesterday_billings = DB::table('subscriptions')->whereDate('created_at', today()->subDays(1))->count();
        $billings_2_days_ago = DB::table('subscriptions')->whereDate('created_at', today()->subDays(2))->count();
        
        return Chartisan::build()
            ->labels([__('2 days ago'), __('Yesterday'), __('Today')])
            ->dataset('User Registration', [$users_2_days_ago, $yesterday_users, $today_users])
            ->dataset('User Subscription', [$billings_2_days_ago, $yesterday_billings, $today_billings]);
    }
}