<?php
namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function landing()
    {
        // jika sudah login maka diarahkan ke halaman kalog/halaman akun masing"
        if (Auth::check()) {

            $role = Auth::user()->profile->role->role;

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('member.catalog');
        }

        // Mengambil maksimal 6 campaign terbaru
        $albums = Album::with([
            'variants',
            'members',
        ])
        ->latest()
        ->take(6)
        ->get();
        
        return view('pages.index', compact('albums'));
    }
}
