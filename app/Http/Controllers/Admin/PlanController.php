<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Stripe;

class PlanController extends Controller
{

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
            'annual_price' => 'required',
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
            'annual_price' => $request->input('annual_price'),
            'interval' => 'Monthly',
            'slug' => Str::slug($request->input('name'), '-'),
            'teams_limit' => 1,
            'branches' => $request->input('branches'),
            'points' => $request->input('points'),
            'channels' => json_encode($request->input('channels')),
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
            'annual_price' => 'required',

        ]);

        $plan = Plan::findOrFail($id);
        // Generate plan slug from plan name
        $slug = str_replace(' ', '-', $request->input('name'));
        $gateway_id = str_replace(' ', '_', $request->input('name'). Str::random(6));

        $plan->title = $request->input('name');
        $plan->stripe_id = $gateway_id;
        $plan->price = $request->input('price');
        $plan->annual_price = $request->input('annual_price');
        $plan->interval = 'Monthly';
        $plan->branches = $request->input('branches');
        $plan->points = $request->input('points');
        $plan->channels = json_encode($request->input('channels'));
        $plan->teams_limit = 1;
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
