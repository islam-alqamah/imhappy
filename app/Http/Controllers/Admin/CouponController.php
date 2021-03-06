<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Stripe;

class CouponController extends Controller
{
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

         * @get('/admin/coupons')
         * @name('admin.coupons.index')
         * @middlewares(web, auth:sanctum, verified)
         */
        // $this->authorize('manage coupons', Coupon::class);

        $coupons = Coupon::all();

        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /**

         * @get('/admin/coupons/create')
         * @name('admin.coupons.create')
         * @middlewares(web, auth:sanctum, verified)
         */
        // $this->authorize('create', Coupon::class);

        return view('admin.coupons.create');
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

         * @post('/admin/coupons')
         * @name('admin.coupons.store')
         * @middlewares(web, auth:sanctum, verified)
         */
        // $this->authorize('create', Coupon::class);

        $this->validate($request, [
            'name' => 'required',
            'percent_off' => 'required',
            'gateway_id' => 'required',
            'duration' => 'required',
        ]);

        // Test if duration_in_months is not empty
        $duration_in_months = ! empty($request->input('duration_in_months')) ? (int) $request->input('duration_in_months') : null;
        $percent_off = (float) $request->input('percent_off');
        // dd($percent_off);

        \Stripe\Coupon::create([
            'name' => $request->input('name'),
            'percent_off' => $percent_off,
            'duration' => $request->input('duration'),
            'duration_in_months' => $duration_in_months,
            'id' => $request->input('gateway_id'),
        ]);

        $coupon = new Coupon([
            'name' => $request->input('name'),
            'percent_off' => $percent_off,
            'duration' => $request->input('duration'),
            'duration_in_months' => $duration_in_months,
            'gateway_id' => $request->input('gateway_id'),
        ]);

        $coupon->save();

        return redirect()->back()->with('status', 'Your Coupon has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $plan)
    {
        /**

         * @get('/admin/coupons/{coupon}')
         * @name('admin.coupons.show')
         * @middlewares(web, auth:sanctum, verified)
         */
        $this->authorize('view', $plan);

        return view('admin.coupons.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /**

         * @get('/admin/coupons/{coupon}/edit')
         * @name('admin.coupons.edit')
         * @middlewares(web, auth:sanctum, verified)
         */
        // $this->authorize('update', Coupon::class);

        $coupon = Coupon::findOrFail($id);

        return view('admin.coupons.edit', compact('coupon', $coupon));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /**

         * @methods(PUT, PATCH)
         * @uri('/admin/coupons/{coupon}')
         * @name('admin.coupons.update')
         * @middlewares(web, auth:sanctum, verified)
         */
        // $this->authorize('update', Coupon::class);

        // Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'interval' => 'required',
        ]);

        $plan = Coupon::findOrFail($id);
        // Generate pla slug from plan name
        $slug = str_replace(' ', '-', $request->input('name'));
        $gateway_id = str_replace(' ', '_', $request->input('name'));
        $team_enable = ! empty($request->input('teams_limit')) ? 1 : 0;
        $teams_limit = ! empty($request->input('teams_limit')) ? $request->input('teams_limit') : null;
        $price = (float) $request->input('price') * 100;
        // Delete the plan on stripe
        $stripe_plan = \Stripe\Coupon::retrieve($plan->gateway_id);
        $stripe_plan->delete();
        // Recrete a new plan on stripe
        \Stripe\Coupon::create([
            'amount' => $price,
            'interval' => $request->input('interval'),
            'product' => [
                'name' => $request->input('name'),
            ],
            'currency' => 'usd',
            'id' => $gateway_id,
            'trial_period_days' => $request->input('trial'),
        ]);

        $plan->name = $request->input('name');
        $plan->gateway_id = $gateway_id;
        $plan->price = $request->input('price');
        $plan->interval = $request->input('interval');
        $plan->teams_enabled = $team_enable;
        $plan->teams_limit = $teams_limit;
        $plan->active = 1;
        $plan->slug = $slug;
        $plan->trial_period_days = $request->input('trial');
        $plan->save();

        return redirect()->back()->with('status', 'Your plan has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /**

         * @delete('/admin/coupons/{coupon}')
         * @name('admin.coupons.destroy')
         * @middlewares(web, auth:sanctum, verified)
         */
        $this->authorize('delete', Coupon::class);
        $plan = Coupon::findOrFail($id);

        $stripe_plan = \Stripe\Coupon::retrieve($plan->gateway_id);
        $stripe_plan->delete();

        // Delete the plan on the database
        $plan->delete();

        return redirect()->back()->with('status', 'Your plan has been deleted.');
    }
}
