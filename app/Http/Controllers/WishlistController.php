<?php
namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function memberWishlist()
    {
        return view('pages.member.wishlist');
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

        $wishlist = Wishlist::where('user_id', $profile->id)
            ->where('album_id', $request->album_id)
            ->first();

        if ($wishlist) {

            $wishlist->delete();

            return response()->json([
                'success' => true,
                'liked'   => false,
            ]);
        }

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
