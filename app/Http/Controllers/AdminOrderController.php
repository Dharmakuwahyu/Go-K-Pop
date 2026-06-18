<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    function adminOrder() {
        return view('pages.admin.orders');
    }
}
