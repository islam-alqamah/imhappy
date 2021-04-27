<?php

namespace App\Http\Controllers\Admin;

use App\Services\StripeClient;
use Illuminate\Routing\Controller;

class StripeBalanceController extends Controller
{
    public function index()
    {
        $balance = (new StripeClient)->getBalance();
        $charges = (new StripeClient)->listCharges(
            request()->only('created', 'customer', 'ending_before', 'limit', 'source', 'starting_after', 'transfer_group')
        );
        dd($charges);
        return view('admin.stripe.index', compact('balance','charges'));
    }

    public function show($id)
    {
        $charge = (new StripeClient)->getCharge($id);
        return view('admin.stripe.show', compact('charge'));
    }
}