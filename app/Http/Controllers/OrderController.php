<?php
namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Order;
use App\Models\OrderPriority;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $album = Album::findOrFail($request->album_id);
        if ($album->slots_left < $request->qty) {
            return response()->json([
                'success' => false,
                'message' => 'Slot tidak mencukupi',
            ], 422);
        }

        $order = Order::create([
            'order_code'      => 'ORD-' . time(),
            'user_id'         => null,
            'album_id'        => $request->album_id,
            'variant_id'      => $request->variant_id,
            'qty'             => $request->qty,
            'price_per_album' => $request->price_per_album,
            'buyer_name'      => 'Guest',
            'buyer_city'      => 'Unknown',
            'status'          => 'pending_dp1',
            'cargo_status'    => 'belum_dikirim',
            'created_at'      => now(),
        ]);

        if ($request->p1) {
            OrderPriority::create([
                'order_id'    => $order->id,
                'priority'    => 1,
                'member_name' => $request->p1,
            ]);
        }

        if ($request->p2) {
            OrderPriority::create([
                'order_id'    => $order->id,
                'priority'    => 2,
                'member_name' => $request->p2,
            ]);
        }

        if ($request->p3) {
            OrderPriority::create([
                'order_id'    => $order->id,
                'priority'    => 3,
                'member_name' => $request->p3,
            ]);
        }

        // ubah kolom sisa slot di tabel albums
        $album->decrement('slots_left', $request->qty);

        return response()->json([
            'success'  => true,
            'order_id' => $order->id,
        ]);
    }
}
