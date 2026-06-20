<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    function memberCatalog() {
        $albums = Album::with([
            'variants',
            'members'
        ])->get();

        return view('pages.member.catalog', compact('albums'));
    }
}
