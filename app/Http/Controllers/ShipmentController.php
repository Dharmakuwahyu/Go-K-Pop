<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function adminShipment()
    {
        $orders = Order::with([
            'album',
            'shipment',
        ])
            ->where('status', 'pelunasan_confirmed')
            ->orderByDesc('created_at')
            ->get();

        return view('pages.admin.logistics', compact('orders'));
    }

    public function updateResi(Request $request)
    {
        $request->validate([
            'order_id'        => ['required', 'exists:orders,id'],
            'tracking_number' => ['required', 'string', 'max:50'],
        ]);

        $order = Order::findOrFail($request->order_id);

        $shipment = Shipment::where('order_id', $order->id)->firstOrFail();

        $shipment->update([
            'tracking_number' => $request->tracking_number,
            'shipped_at'      => now(),
        ]);

        $order->update([
            'status' => 'shipped',
        ]);

        return response()->json([
            'success'  => true,
            'message'  => 'Nomor resi berhasil disimpan.',
            'order_id' => $order->id,
        ]);

    }
}
