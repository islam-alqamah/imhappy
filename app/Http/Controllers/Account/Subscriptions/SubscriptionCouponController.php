<?php

namespace App\Http\Controllers\Account\Subscriptions;

use App\Http\Controllers\Controller;
use App\Rules\ValidCoupon;
use Illuminate\Http\Request;

class SubscriptionCouponController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'subscribed']);
    }

    public function index(Request $request)
    {
        /**

         * @get('/account/subscriptions/coupon')
         * @name('account.subscriptions.coupon')
         * @middlewares(web, verified, auth, subscribed)
         */
        return view('account.subscriptions.coupon');
    }

    public function store(Request $request)
    {
        /**

         * @post('/account/subscriptions/coupon')
         * @name('')
         * @middlewares(web, verified, auth, subscribed)
         */
        $this->validate($request, [
            'coupon' => ['required',
            new ValidCoupon(),
        ],
        ]);

        currentTeam()->subscription('default')->updateStripeSubscription([
            'coupon' => $request->coupon,
        ]);

        return redirect()->route('account.subscriptions');
    }
}
