<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipment extends Model
{
    protected $table = 'shipments';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'address',
        'courier',
        'tracking_number',
        'shipping_cost',
        'shipped_at',
    ];

    protected $casts = [
        'shipping_cost' => 'integer',
        'shipped_at'    => 'datetime',
    ];

    // ============================================================
    // RELASI
    // ============================================================

    /**
     * Pesanan yang dikirim (1 pesanan = 1 pengiriman).
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
