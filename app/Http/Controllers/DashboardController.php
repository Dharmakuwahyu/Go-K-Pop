<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    function memberDashboard() {
        return view('pages.member.dashboard');
    }

}
