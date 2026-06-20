<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $table = 'orders';

    // Tabel orders hanya punya created_at, tidak ada updated_at
    public $timestamps = false;

    protected $fillable = [
        'order_code',
        'user_id',
        'album_id',
        'variant_id',
        'qty',
        'price_per_album',
        'buyer_name',
        'buyer_city',
        'status',
        'cargo_status',
        'created_at',
    ];

    protected $casts = [
        'qty'             => 'integer',
        'price_per_album' => 'integer',
        'created_at'      => 'datetime',
    ];

    // ============================================================
    // RELASI
    // ============================================================

    /**
     * Pembeli pesanan ini.
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'user_id', 'id');
    }

    /**
     * Album yang dipesan.
     */
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class, 'album_id', 'id');
    }

    /**
     * Varian album yang dipilih.
     */
    public function variant(): BelongsTo
    {
        return $this->belongsTo(AlbumVariant::class, 'variant_id', 'id');
    }

    /**
     * Daftar prioritas member yang dipilih (1, 2, 3).
     */
    public function priorities(): HasMany
    {
        return $this->hasMany(OrderPriority::class, 'order_id', 'id');
    }

    /**
     * Riwayat pembayaran untuk pesanan ini (DP1, DP2, Pelunasan).
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'order_id', 'id');
    }

    /**
     * Data pengiriman pesanan ini (1 pesanan = 1 pengiriman).
     */
    public function shipment(): HasOne
    {
        return $this->hasOne(Shipment::class, 'order_id', 'id');
    }

    /**
     * Hasil sorting PC untuk pesanan ini.
     */
    public function sortingResult(): HasOne
    {
        return $this->hasOne(SortingResult::class, 'order_id', 'id');
    }
}
