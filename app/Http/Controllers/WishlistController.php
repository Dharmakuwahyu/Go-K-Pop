<?php
namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function memberWishlist()
    {
        $profile = Auth::user()->profile;

        $wishlists = Wishlist::with([
            'album.variants',
            'album.members',
        ])
            ->where('user_id', $profile->id)
            ->latest('created_at')
            ->get();

        return view('pages.member.wishlist', compact('wishlists'));
    }

    public function toggle(Request $request)
    {
        $profile = Auth::user()->profile;

        if (! $profile) {
            return response()->json([
                'success' => false,
                'message' => 'Profile tidak ditemukan.',
            ], 422);
        }

        // cek apakah ada data wishlist
        $wishlist = Wishlist::where('user_id', $profile->id)
            ->where('album_id', $request->album_id)
            ->first();

        // jika ada maka delete
        if ($wishlist) {

            $wishlist->delete();

            return response()->json([
                'success' => true,
                'liked'   => false,
            ]);
        }

        // jika belum ada tambahkan data wishlist ke tabel
        Wishlist::create([
            'user_id'  => $profile->id,
            'album_id' => $request->album_id,
        ]);

        return response()->json([
            'success' => true,
            'liked'   => true,
        ]);
    }
}
