<?php

namespace App\Http\Controllers\Account\Subscriptions;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Laravel\Cashier\Exceptions\PaymentActionRequired;
use Snowfire\Beautymail\Beautymail;

class SubscriptionSwapController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        /**

         * @get('/account/subscriptions/swap')
         * @name('account.subscriptions.swap')
         * @middlewares(web, verified, auth)
         */
        $plans = Plan::where('slug', '!=', currentTeam()->plan->slug)->get();

        return view('account.subscriptions.swap', compact('plans'));
    }

    public function store(Request $request)
    {
        /**

         * @post('/account/subscriptions/swap')
         * @name('')
         * @middlewares(web, verified, auth)
         */
        $this->validate($request, [
            'plan' => 'required|exists:plans,slug',
        ]);
        // test if user chose the current plan
        if ($request->plan == currentTeam()->plan->slug) {
            notify()->error(__('You already subscribed to this plan !'));

            return redirect()->back();
        }

        try {
            currentTeam()->subscription('default')
            ->swap(Plan::where('slug', $request->plan)->first()->stripe_id);
        } catch (PaymentActionRequired $e) {
            return redirect()->route(
                'cashier.payment',
                [
                    $e->payment->id,
                    'redirect' => route('account.subscriptions'),
                ]
            );
        }

        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('emails.subscription.swapped', ['user' => currentTeam()->owner], function ($message) {
            $message
                ->from(config('mail.from.address'))
                ->to(currentTeam()->owner->email)
                ->subject(__('Subscription Plan Changed'));
        });

        notify()->success(__('Your plan has been changed !'));

        return redirect()->route('account.subscriptions');
    }
}
