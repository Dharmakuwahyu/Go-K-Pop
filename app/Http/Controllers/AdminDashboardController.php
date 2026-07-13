<?php
namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Profile;

class AdminDashboardController extends Controller
{
    public function adminDashboard()
    {
        // Mengambil seluruh data campaign beserta jumlah pesanan pada setiap campaign
        $albums = Album::withCount('orders')
            ->latest()
            ->get();

        // Menghitung total omset dari pembayaran yang sudah diverifikasi
        $totalRevenue = Payment::where('status', 'verified')
            ->sum('amount');

        // Menghitung total pengguna yang terdaftar
        $totalUsers = Profile::count();

        // Menghitung total slot dari seluruh campaign
        $totalSlots = Album::sum('total_slots');

        // Menghitung total sisa slot dari seluruh campaign
        $totalSlotsLeft = Album::sum('slots_left');

        // Menghitung persentase kuota yang sudah terisi
        $quotaPercentage = $totalSlots > 0
            ? round((($totalSlots - $totalSlotsLeft) / $totalSlots) * 100)
            : 0;

        // Menghitung total seluruh pesanan
        $totalOrders = Order::count();

        // Mengambil campaign dengan jumlah pesanan terbanyak
        $trendingAlbum = Album::withCount('orders')
            ->orderByDesc('orders_count')
            ->first();

        // Mengirim data campaign ke halaman dashboard
        return view('pages.admin.home', compact(
            'albums',
            'totalRevenue',
            'totalUsers',
            'quotaPercentage',
            'totalOrders',
            'trendingAlbum'
        ));
    }
}
