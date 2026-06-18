<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    function memberWishlist() {
        return view('pages.member.wishlist');
    }
}
