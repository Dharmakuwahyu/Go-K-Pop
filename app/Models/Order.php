<?php
namespace App\Models;

use Carbon\Carbon;
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

    /**
     * Pembayaran DP1 yang sudah diverifikasi.
     */
    public function dp1Payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'order_id', 'id')
            ->where('phase', 'DP 1')
            ->where('status', 'verified');
    }

    // =============================================
    // STATUS
    // =============================================
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'pending_dp1'         => 'Menunggu DP 1',
            'dp1_confirmed'       => 'DP 1 Terverifikasi',
            'pending_dp2'         => 'Menunggu DP 2',
            'dp2_confirmed'       => 'DP 2 Terverifikasi',
            'pending_pelunasan'   => 'Menunggu Pelunasan',
            'pelunasan_confirmed' => 'Pelunasan Terverifikasi',
            'shipped'             => 'Sudah Dikirim',
            default               => $this->status,
        };
    }

    // pemanggilan status_color
    public function getStatusColorAttribute()
    {
        return match ($this->status) {
            'pending_dp1',
            'pending_dp2',
            'pending_pelunasan'   => 'yellow',

            'dp1_confirmed',
            'dp2_confirmed',
            'pelunasan_confirmed' => 'blue',

            'shipped'             => 'green',

            default               => 'yellow',
        };
    }

    public function getActionLabelAttribute()
    {
        return match ($this->status) {
            'pending_dp1'       => 'Bayar Sekarang (DP 1)',
            'pending_dp2'       => 'Bayar Sekarang (DP 2)',
            'pending_pelunasan' => 'Bayar Pelunasan',

            default             => '-',
        };
    }

    public function getCurrentPaymentAttribute()
    {
        $phase = match ($this->status) {
            'pending_dp1',
            'dp1_confirmed'       => 'DP 1',

            'pending_dp2',
            'dp2_confirmed'       => 'DP 2',

            'pending_pelunasan',
            'pelunasan_confirmed' => 'Pelunasan',

            default               => null,
        };

        if (! $phase) {
            return null;
        }

        return $this->payments
            ->where('phase', $phase)
            ->sortByDesc('uploaded_at')
            ->first();
    }

    // =============================================
    // PERHITUNGAN HARGA
    // =============================================
    // Total harga seluruh album
    public function getTotalPriceAttribute()
    {
        return $this->price_per_album * $this->qty;
    }

    // DP 1 = 35%
    public function getDp1AmountAttribute()
    {
        return round($this->total_price * 0.35);
    }

    // DP 2 = 35%
    public function getDp2AmountAttribute()
    {
        return round($this->total_price * 0.35);
    }

    // Pelunasan = 30%
    public function getPelunasanAmountAttribute()
    {
        return $this->total_price - $this->dp1_amount - $this->dp2_amount;
    }

    // Nominal yang harus dibayar sesuai status
    public function getCurrentPaymentAmountAttribute()
    {
        return match ($this->status) {
            'pending_dp1'       => $this->dp1_amount,
            'pending_dp2'       => $this->dp2_amount,
            'pending_pelunasan' => $this->pelunasan_amount,
            default             => 0,
        };
    }

    public function getPaidAmountAttribute()
    {
        return $this->payments
            ->where('status', 'verified')
            ->sum('amount');
    }

    public function getRemainingPriceAttribute()
    {
        return $this->total_price - $this->paid_amount;
    }

    // =============================================
    // FORMAT
    // =============================================
    public function getFormattedCreatedAtAttribute()
    {
        Carbon::setLocale('id');

        return $this->created_at
            ->translatedFormat('d F Y \p\u\k\u\l H.i') . ' WIB';
    }

}
