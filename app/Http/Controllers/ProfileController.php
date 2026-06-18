<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    function memberProfile() {
        return view('pages.member.profile');
    }
}
