<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
    function adminPayment() {
        return view('pages.admin.payments');
    }
}
