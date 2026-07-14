<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function memberBeranda() {
        return view('pages.member.beranda');
    }
}
