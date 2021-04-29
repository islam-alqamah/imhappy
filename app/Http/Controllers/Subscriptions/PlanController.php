<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    public function index()
    {
        /**

         * @get('/plans')
         * @name('subscription.plans')
         * @middlewares(web)
         */
        // $plans = Plan::get();
        return view('subscriptions.plans');
    }
}
