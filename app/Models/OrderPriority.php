<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderPriority extends Model
{
    protected $table = 'order_priorities';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'priority',
        'member_name',
    ];

    protected $casts = [
        'priority' => 'integer',
    ];

    // ============================================================
    // RELASI
    // ============================================================

    /**
     * Pesanan induk dari prioritas ini.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
