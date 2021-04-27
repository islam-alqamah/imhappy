<?php

namespace App\Http\Controllers\Account\Subscriptions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Snowfire\Beautymail\Beautymail;

class SubscriptionResumeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'subscribed']);
    }

    public function index(Request $request)
    {
        /**

         * @get('/account/subscriptions/resume')
         * @name('account.subscriptions.resume')
         * @middlewares(web, verified, auth, subscribed)
         */
        return view('account.subscriptions.resume');
    }

    public function store(Request $request)
    {
        /**

         * @post('/account/subscriptions/resume')
         * @name('')
         * @middlewares(web, verified, auth, subscribed)
         */
        // $this->authorize('resume', $subscription = currentTeam()->subscription('default'));
        $subscription = currentTeam()->subscription('default');
        $subscription->resume();

        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('emails.subscription.resumed', ['user' => currentTeam()->owner], function ($message) {
            $message
                ->from(config('mail.from.address'))
                ->to(currentTeam()->owner->email)
                ->subject(__('Subscription Resumed'));
        });

        notify()->success(__('Subscription has been resumed !'));

        return redirect()->route('account.subscriptions');
    }
}
