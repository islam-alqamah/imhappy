<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stripe;

class PlanController extends Controller
{
    // private $stripe;
    public function __construct()
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        /**

         * @get('/admin/plans')
         * @name('admin.plans.index')
         * @middlewares(web, auth:sanctum, verified)
         */
        // $this->authorize('create', Plan::class);

        $plans = Plan::paginate(10);

        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /**

         * @get('/admin/plans/create')
         * @name('admin.plans.create')
         * @middlewares(web, auth:sanctum, verified)
         */

        return view('admin.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**

         * @post('/admin/plans')
         * @name('admin.plans.store')
         * @middlewares(web, auth:sanctum, verified)
         */
        $this->demoMode();

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'interval' => 'required',
            // 'max_domain' => 'required',
            // 'mailboxes' => 'required',
            // 'quota' => 'required',
            'teams_limit' => 'required',
        ]);

        $gateway_id = str_replace(' ', '_', $request->input('name'). Str::random(6));
        $price = (float) $request->input('price') * 100;

//        $stripe = \Stripe\Plan::create([
//            'amount' => $price,
//            'interval' => $request->input('interval'),
//            'product' => [
//                'name' => $request->input('name'),
//            ],
//            'currency' => config('cashier.currency'),
//            "id" => $gateway_id,
//            'trial_period_days' => $request->input('trial'),
//        ]);

        $plan = new Plan([
            'title' => $request->input('name'),
            'stripe_id' => $gateway_id, //$stripe->id,
            'price' => $request->input('price'),
            'interval' => $request->input('interval'),
            'slug' => Str::slug($request->input('name'), '-'),
            'teams_limit' => $request->input('teams_limit'),
            'active' => 1,
            'trial_period_days' => $request->input('trial'),
            // 'max_domain' => $request->input('max_domain'),
            // 'mailboxes' => $request->input('mailboxes'),
            // 'quota' => $request->input('quota'),
        ]);

        $plan->save();

        notify()->success(__('Your plan has been created.'));

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Plan $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        /**

         * @get('/admin/plans/{plan}')
         * @name('admin.plans.show')
         * @middlewares(web, auth:sanctum, verified)
         */
        // $this->authorize('view', $plan);

        return view('admin.plans.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Plan $plan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /**

         * @get('/admin/plans/{plan}/edit')
         * @name('admin.plans.edit')
         * @middlewares(web, auth:sanctum, verified)
         */
        // $this->authorize('update', Plan::class);

        $plan = Plan::findOrFail($id);

        return view('admin.plans.edit', compact('plan', $plan));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  App\Models\Plan $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /**

         * @methods(PUT, PATCH)
         * @uri('/admin/plans/{plan}')
         * @name('admin.plans.update')
         * @middlewares(web, auth:sanctum, verified)
         */

        $this->demoMode();

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'interval' => 'required',
            'teams_limit' => 'required',
        ]);

        $plan = Plan::findOrFail($id);
        // Generate plan slug from plan name
        $slug = str_replace(' ', '-', $request->input('name'));
        $gateway_id = str_replace(' ', '_', $request->input('name'). Str::random(6));
        $team_enable = ! empty($request->input('teams_limit')) ? 1 : 0;
        $teams_limit = ! empty($request->input('teams_limit')) ? $request->input('teams_limit') : null;
        $price = (float) $request->input('price') * 100;
        // Delete the plan on stripe
        if ($plan->price != $request->input('price') || $plan->interval != $request->input('interval') || $plan->trial_period_days != $request->input('trial')) {
            $stripe_plan = \Stripe\Plan::retrieve($plan->stripe_id);
            $stripe_plan->delete();
            // Recrete a new plan on stripe
            \Stripe\Plan::create([
                'amount' => $price,
                'interval' => $request->input('interval'),
                'product' => [
                    'name' => $request->input('name'),
                ],
                'currency' => 'usd',
                'id' => $gateway_id,
                'trial_period_days' => $request->input('trial'),
            ]);
        }
        $plan->title = $request->input('name');
        $plan->stripe_id = $gateway_id;
        $plan->price = $request->input('price');
        $plan->interval = $request->input('interval');
        $plan->teams_limit = $teams_limit;
        $plan->active = 1;
        $plan->slug = $slug;
        // $plan->max_domain = $request->input('max_domain');
        // $plan->trial_period_days = $request->input('trial');
        // $plan->mailboxes = $request->input('mailboxes');
        // $plan->quota = $request->input('quota');
        $plan->save();

        return redirect()->back()->with('status', 'Your plan has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Plan $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /**

         * @delete('/admin/plans/{plan}')
         * @name('admin.plans.destroy')
         * @middlewares(web, auth:sanctum, verified)
         */
        $this->demoMode();
        $plan = Plan::findOrFail($id);

        $stripe_plan = \Stripe\Plan::retrieve($plan->gateway_id);
        $stripe_plan->delete();

        // Delete the plan on the database
        $plan->delete();

        return redirect()->back()->with('status', 'Your plan has been deleted.');
    }

    public function demoMode(){
        abort_if(config('saas.demo_mode'),403,'Unauthorized action on demo mode! Please Buy Saasify to test that feature');
    }
}
