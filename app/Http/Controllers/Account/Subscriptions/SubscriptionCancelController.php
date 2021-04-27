<?php

namespace App\Http\Controllers\Account\Subscriptions;

use App\Http\Controllers\Controller;
use App\Mail\Subscription\SubscriptionCancelled;
use App\Models\SubscriptionCancelation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Snowfire\Beautymail\Beautymail;

class SubscriptionCancelController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'subscribed']);
    }

    public function index(Request $request)
    {
        /**

         * @get('/account/subscriptions/cancel')
         * @name('account.subscriptions.cancel')
         * @middlewares(web, verified, auth, subscribed)
         */
        return view('account.subscriptions.cancel');
    }

    public function store(Request $request)
    {
        /**

         * @post('/account/subscriptions/cancel')
         * @name('')
         * @middlewares(web, verified, auth, subscribed)
         */
        $this->demoMode();

        // $this->authorize('cancel', $subscription = currentTeam()->subscription('default'));
        $subscription = currentTeam()->subscription('default');
        $subscription->cancel();

        SubscriptionCancelation::create([
            'team_id' => currentTeam()->id,
            'reason'  => $request->reason,
        ]);
        // Mail::to(currentTeam()->owner)->queue(new SubscriptionCancelled(currentTeam()->owner));

        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('emails.subscription.cancelled', ['user' => currentTeam()->owner], function ($message) {
            $message
                ->from(config('mail.from.address'))
                ->to(currentTeam()->owner->email)
                ->subject(__('Subscription Cancelled'));
        });

        notify()->success(__('Subscription has been canceled !'));

        return redirect()->route('account.subscriptions');
    }

    public function demoMode(){
        abort_if(config('saas.demo_mode'),403,'Unauthorized action on demo mode! Please Buy Saasify to test that feature');
    }
}
