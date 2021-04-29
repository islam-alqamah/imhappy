<?php

namespace App\Http\Controllers\Account\Subscriptions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionInvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        /**

         * @get('/account/subscriptions/invoices')
         * @name('account.subscriptions.invoices')
         * @middlewares(web, verified, auth)
         */
        $invoices = currentTeam()->invoices();
        // dd($invoices);
        return view('account.subscriptions.invoices', compact('invoices'));
    }

    public function show(Request $request, $id)
    {
        /**

         * @get('/account/subscriptions/invoices/{id}')
         * @name('account.subscriptions.invoice')
         * @middlewares(web, verified, auth)
         */
        return redirect(currentTeam()->findInvoice($id)->asStripeInvoice()->invoice_pdf);
        // return $request->user()->downloadInvoice($id, [
        //     'vendor' => config('app.name'),
        //     'product' => 'Membership'
        // ]);
    }
}
