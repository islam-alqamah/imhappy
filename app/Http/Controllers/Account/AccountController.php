<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        /**

         * @get('/account')
         * @name('account')
         * @middlewares(web, verified, auth)
         */
        return view('account.index');
    }

    public function preference()
    {
        /**

         * @get('/account/preference')
         * @name('account.preference')
         * @middlewares(web, verified, auth)
         */
        return view('account.preference');
    }
    public function payments(){
        $payments = currentTeam()->payments;
        return view('account.payment-history',compact('payments'));
    }
    public function payment($id){
        $payment = Payment::find($id);
        return view('account.invoice',compact('payment'));
    }
}
