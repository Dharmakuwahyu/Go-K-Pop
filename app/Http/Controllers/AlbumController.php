<?php
namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function memberCatalog()
    {
        $albums = Album::with([
            'variants',
            'members',
        ])->get();
        
        // menampilkan data album yang dilike
        $profile = Auth::user()->profile;
        $wishlistAlbumIds = Wishlist::where('user_id', $profile->id)
            ->pluck('album_id')
            ->toArray();

        return view('pages.member.catalog', compact('albums', 'wishlistAlbumIds'));
    }

    public function showFormPembelian(Album $album)
    {
        $album->load([
            'variants',
            'members',
        ]);

        return response()->json($album);
    }
}
