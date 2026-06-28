<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    function memberDashboard() {
        $profile = Auth::user()->profile;

        $orders = Order::with([
            'album',
            'variant',
            'payments',
            'priorities' => function ($query) {
                $query->orderBy('priority');
            },
        ])
        ->where('user_id', $profile->id)
        ->latest('created_at')
        ->get();

        return view('pages.member.dashboard', compact('orders'));
    }

}
