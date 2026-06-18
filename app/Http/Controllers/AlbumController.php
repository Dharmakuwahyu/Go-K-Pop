<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlbumController extends Controller
{
    function memberCatalog() {
        return view('pages.member.catalog');
    }
}
