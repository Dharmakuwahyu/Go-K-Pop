<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('pages.admin.payments', compact('payments'));
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

        $payment->save();

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil diverifikasi.',
        ]);
    }

    public function reject(Request $request, Payment $payment)
    {
        $request->validate([
            'reason' => ['required', 'max:255'],
        ]);

        $payment->update([
            'status'        => 'rejected',
            'reject_reason' => $request->reason,
            'verified_by'   => Auth::user()->profile->id,
            'verified_at'   => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil ditolak.',
        ]);
    }
}
