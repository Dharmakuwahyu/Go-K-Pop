<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $table = 'payments';

    // Tabel payments pakai uploaded_at & verified_at, bukan timestamps default
    public $timestamps = false;

    protected $fillable = [
        'payment_code',
        'order_id',
        'phase',
        'amount',
        'proof_image_url',
        'status',
        'reject_reason',
        'verified_by',
        'uploaded_at',
        'verified_at',
    ];

    protected $casts = [
        'amount'      => 'integer',
        'uploaded_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    // ============================================================
    // RELASI
    // ============================================================

    /**
     * Pesanan yang dibayar.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    /**
     * Admin yang memverifikasi pembayaran ini.
     */
    public function verifier(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'verified_by', 'id');
    }
}
