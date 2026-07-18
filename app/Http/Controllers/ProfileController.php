<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function memberProfile()
    {
        $user = User::with('profile.role')
            ->findOrFail(Auth::id());

        $profile = $user->profile;

        $totalOrders = Order::where('user_id', $profile->id)->count();

        $activeOrders = Order::where('user_id', $profile->id)
            ->whereIn('status', [
                'pending_dp1',
                'dp1_confirmed',
                'pending_dp2',
                'dp2_confirmed',
                'pending_pelunasan',
                'pelunasan_confirmed',
            ])
            ->count();

        $completedOrders = Order::where('user_id', $profile->id)
            ->where('status', 'shipped')
            ->count();

        return view('pages.member.profile', compact(
            'user',
            'profile',
            'totalOrders',
            'activeOrders',
            'completedOrders'
        ));
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
                'full_name' => ['required', 'string', 'max:100'],
                'phone' => ['nullable', 'regex:/^[0-9]{10,15}$/'],
                'address'   => ['nullable', 'string'],
            ],
            [
                'full_name.required' => 'Nama lengkap wajib diisi.',
                'full_name.string'   => 'Nama lengkap tidak valid.',
                'full_name.max'      => 'Nama lengkap maksimal 100 karakter.',

                'phone.regex' => 'Nomor WhatsApp harus berupa angka dengan panjang 10–15 digit.',

                'address.string'     => 'Alamat tidak valid.',
            ]);

        $user = User::with('profile')
            ->findOrFail(Auth::id());

        $user->update([
            'name' => $validated['full_name'],
        ]);

        $user->profile->update([
            'full_name' => $validated['full_name'],
            'phone'     => $validated['phone'],
            'address'   => $validated['address'],
        ]);

        return back()->with('success', 'Perubahan berhasil disimpan!');
    }
}
