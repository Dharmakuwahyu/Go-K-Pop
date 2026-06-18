<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    function adminShipment() {
        return view('pages.admin.logistics');
    }
}
