<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SortingResult extends Model
{
    protected $table = 'sorting_results';

    public $timestamps = false;

    protected $fillable = [
        'session_id',
        'order_id',
        'assigned_member',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    // ============================================================
    // RELASI
    // ============================================================

    /**
     * Sesi sortir induk dari hasil ini.
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(SortingSession::class, 'session_id', 'id');
    }

    /**
     * Pesanan yang mendapat hasil sortir ini.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
