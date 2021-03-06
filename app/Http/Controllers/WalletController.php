<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function balance(Request $req)
    {
        $rate = new Rate();
        $lbc_balance = bitcoind()->getbalance(auth()->user()->username)[0];
        $rate_dollar = $rate->last_dollar;
        return "LBC : ".$lbc_balance." = $ ".number_format($lbc_balance * $rate_dollar, 2);
    }
}
