<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id'    => ['required', 'exists:orders,id'],
            'proof_image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
        ],
        [
            'proof_image.required' => 'Silakan pilih bukti transfer.',
            'proof_image.image'    => 'File harus berupa gambar.',
            'proof_image.mimes'    => 'Format gambar harus JPG, JPEG, atau PNG.',
            'proof_image.max'      => 'Ukuran gambar maksimal 5 MB.',
        ]);

        if ($validator->fails()) {
            Log::info($validator->errors()->toArray());

            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors'  => $validator->errors(),
            ], 422);
        }

        $profile = Auth::user()->profile;
        $order = Order::findOrFail($request->order_id);
        if ($order->user_id !== $profile->id) {
            abort(403);
        }

        $phase = match ($order->status) {
            'pending_dp1'       => 'DP 1',
            'pending_dp2'       => 'DP 2',
            'pending_pelunasan' => 'Pelunasan',
            default             => null,
        };
        if (! $phase) {
            return response()->json([
                'success' => false,
                'message' => 'Tahap pembayaran tidak valid.',
            ], 400);
        }

        // Jangan boleh upload dua kali untuk tahap yang sama
        $existingPayment = Payment::where('order_id', $order->id)
            ->where('phase', $phase)
            ->whereIn('status', ['pending', 'verified'])
            ->exists();

        if ($existingPayment) {
            return response()->json([
                'success' => false,
                'message' => 'Bukti pembayaran untuk tahap ini sudah pernah diupload.',
            ], 422);
        }

        // Generate payment code
        $lastPayment = Payment::latest('id')->first();

        $nextNumber = $lastPayment
            ? ((int) substr($lastPayment->payment_code, 4)) + 1
            : 1;

        $paymentCode = 'PAY-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

        // Nama file mengikuti payment code
        $extension = $request->file('proof_image')->getClientOriginalExtension();
        $fileName  = $paymentCode . '.' . $extension;

        // Simpan file
        $request->file('proof_image')->storeAs(
            'payments',
            $fileName,
            'public'
        );

        // Simpan pembayaran
        Payment::create([
            'payment_code'    => $paymentCode,
            'order_id'        => $order->id,
            'phase'           => $phase,
            'amount'          => $order->current_payment_amount,
            'proof_image_url' => $fileName,
            'status'          => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Bukti pembayaran berhasil diupload.',
        ]);
    }

}
