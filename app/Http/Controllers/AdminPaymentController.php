<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminPaymentController extends Controller
{
    public function adminPayment()
    {
        $payments = Payment::with([
            'order.album',
            'order.variant',
            'order.buyer',
        ])
            ->where('status', 'pending')
            ->latest('uploaded_at')
            ->get();

        $nextPhaseOrders = Order::with([
            'album',
            'buyer',
        ])
            ->whereIn('status', [
                'dp1_confirmed',
                'dp2_confirmed',
            ])
            ->latest('created_at')
            ->get();

        return view('pages.admin.payments', compact('payments', 'nextPhaseOrders'));
    }

    public function approve(Payment $payment)
    {
        if ($payment->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran ini sudah diproses.',
            ], 422);
        }

        $order = $payment->order;

        $order->status = match ($payment->phase) {
            'DP 1'      => 'dp1_confirmed',
            'DP 2'      => 'dp2_confirmed',
            'Pelunasan' => 'pelunasan_confirmed',
        };

        $order->save();

        $profile = Auth::user()->profile;

        $payment->status      = 'verified';
        $payment->verified_by = $profile->id;
        $payment->verified_at = now();

        // Hapus file bukti transfer
        if (
            $payment->proof_image_url &&
            Storage::disk('public')->exists('payments/' . $payment->proof_image_url)
        ) {
            Storage::disk('public')->delete('payments/' . $payment->proof_image_url);
        }

        // Kosongkan nama file di database
        $payment->proof_image_url = null;

        $payment->save();

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil diverifikasi.',
        ]);
    }

    public function reject(Request $request, Payment $payment)
    {
        if ($payment->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Pembayaran ini sudah diproses.',
            ], 422);
        }

        $request->validate([
            'reason' => ['required', 'max:255'],
        ]);

        // Hapus file bukti transfer
        if (
            $payment->proof_image_url &&
            Storage::disk('public')->exists('payments/' . $payment->proof_image_url)
        ) {
            Storage::disk('public')->delete('payments/' . $payment->proof_image_url);
        }

        $payment->status          = 'rejected';
        $payment->reject_reason   = $request->reason;
        $payment->verified_by     = Auth::user()->profile->id;
        $payment->verified_at     = now();
        $payment->proof_image_url = null;

        $payment->save();

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil ditolak.',
        ]);
    }

    public function nextPhase(Order $order)
    {
        if (! in_array($order->status, [
            'dp1_confirmed',
            'dp2_confirmed',
        ])) {
            return response()->json([
                'success' => false,
                'message' => 'Status pesanan tidak valid.',
            ], 422);
        }

        $order->status = match ($order->status) {
            'dp1_confirmed' => 'pending_dp2',
            'dp2_confirmed' => 'pending_pelunasan',
        };

        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Tahap pembayaran berhasil dibuka.',
        ]);
    }
}
