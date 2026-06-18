<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoreSettingController extends Controller
{
    function adminStoreSetting() {
        return view('pages.admin.settings');
    }
}
