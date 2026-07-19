<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function memberBeranda() {

        // Mengambil maksimal 6 campaign terbaru
        $albums = Album::with([
            'variants',
            'members',
        ])
        ->latest()
        ->take(6)
        ->get();
        
        // menampilkan data album yang dilike
        $profile = Auth::user()->profile;
        $wishlistAlbumIds = Wishlist::where('user_id', $profile->id)
            ->pluck('album_id')
            ->toArray();
            
        return view('pages.member.beranda', compact('albums', 'wishlistAlbumIds'));
    }
}
