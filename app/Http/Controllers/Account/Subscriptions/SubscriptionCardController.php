<?php

namespace App\Http\Controllers\Account\Subscriptions;

use Illuminate\Http\Request;
use Snowfire\Beautymail\Beautymail;
use App\Http\Controllers\Controller;

class SubscriptionCardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        /**

         * @get('/account/subscriptions/card')
         * @name('account.subscriptions.card')
         * @middlewares(web, verified, auth)
         */
        return view('account.subscriptions.card');
    }

    public function store(Request $request)
    {
        /**

         * @post('/account/subscriptions/card')
         * @name('')
         * @middlewares(web, verified, auth)
         */
        $this->validate($request, [
            'name' => 'required',
            'token' => 'required',
        ]);

        currentTeam()->updateDefaultPaymentMethod($request->token);

        return redirect()->route('account.subscriptions');
    }

    public function newPaymentMethod(Request $request)
    {
        /**

         * @post('/account/subscriptions/newcard')
         * @name('account.subscriptions.newcard')
         * @middlewares(web, verified, auth)
         */
        $this->validate($request, [
            'name' => 'required',
            'token' => 'required',
        ]);

        currentTeam()->addPaymentMethod($request->token);

        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('emails.subscription.card', ['user' => currentTeam()->owner], function ($message) {
            $message
                ->from(config('mail.from.address'))
                ->to(currentTeam()->owner->email)
                ->subject(__('New payment method added'));
        });

        notify()->success(__('Payment method has been added'));

        return redirect()->back();
    }
}
