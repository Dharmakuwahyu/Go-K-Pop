<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function landing()
    {
        if (Auth::check()) {

            $role = Auth::user()->profile->role->role;

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('member.catalog');
        }
        
        return view('pages.index');
    }
}
