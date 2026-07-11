<?php
namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Order;

class AdminOrderController extends Controller
{
    public function adminOrder()
    {
        $orders = Order::with([
            'album',
            'variant',
            'priorities',
            'payments',
        ])
            ->latest('created_at')
            ->get();

        $albums = Album::orderBy('group_name')->get();

        $statuses = $orders
            ->pluck('status')
            ->unique()
            ->map(function ($status) use ($orders) {
                $order = $orders->firstWhere('status', $status);

                return [
                    'value' => $status,
                    'label' => $order->status_label,
                ];
            })
            ->values();

        $totalOrders = $orders->count();

        $pendingOrders = $orders->whereIn('status', [
            'pending_dp1',
            'pending_dp2',
            'pending_pelunasan',
        ])->count();

        $paidOrders = $orders->whereIn('status', [
            'pelunasan_confirmed',
            'shipped',
        ])->count();

        return view('pages.admin.orders', compact(
            'orders',
            'albums',
            'statuses',
            'totalOrders',
            'pendingOrders',
            'paidOrders'
        ));
    }

    /**
     * Mengambil seluruh data pesanan dalam format JSON.
     *
     * Digunakan oleh AJAX untuk:
     * - Menampilkan tabel pesanan
     * - Melakukan pencarian (search)
     * - Filter album
     * - Filter status
     * - Auto refresh data tanpa reload halaman
     */
    public function getOrders()
    {
        // Ambil seluruh data pesanan beserta relasi yang dibutuhkan
        $orders = Order::with([
            'album',
            'variant',
            'priorities',
            'payments',
        ])
            ->latest('created_at')
            ->get();

        // Kembalikan data dalam bentuk JSON
        return response()->json([
            'orders'     => $orders,

            'statistics' => [
                'total_orders'   => $orders->count(),

                'pending_orders' => $orders->whereIn('status', [
                    'pending_dp1',
                    'pending_dp2',
                    'pending_pelunasan',
                ])->count(),

                'paid_orders'    => $orders->whereIn('status', [
                    'pelunasan_confirmed',
                    'shipped',
                ])->count(),
            ],
        ]);
    }
}
