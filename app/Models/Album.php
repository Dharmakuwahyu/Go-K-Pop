<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    protected $table   = 'albums';
    public $timestamps = true;

    protected $fillable = [
        'group_name',
        'title',
        'price',
        'total_slots',
        'slots_left',
        'image_url',
        'status',
        'created_by',
    ];

    protected $casts = [
        'price'       => 'integer',
        'total_slots' => 'integer',
        'slots_left'  => 'integer',
    ];

    /**
     * Accessor yang otomatis ikut dikirim saat model diubah menjadi JSON.
     */
    protected $appends = [
        'progress',
        'progress_color',
    ];

    // ============================================================
    // RELASI
    // ============================================================

    /**
     * Admin yang membuat campaign ini.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'created_by', 'id');
    }

    /**
     * Varian album (Photobook, Digipack, dll).
     */
    public function variants(): HasMany
    {
        return $this->hasMany(AlbumVariant::class, 'album_id', 'id');
    }

    /**
     * Member / idol dalam grup album ini.
     */
    public function members(): HasMany
    {
        return $this->hasMany(AlbumMember::class, 'album_id', 'id');
    }

    /**
     * Pesanan yang masuk untuk album ini.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'album_id', 'id');
    }

    /**
     * Wishlist user yang menyimpan album ini.
     */
    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'album_id', 'id');
    }

    /**
     * Sesi sorting PC untuk album ini.
     */
    public function sortingSessions(): HasMany
    {
        return $this->hasMany(SortingSession::class, 'album_id', 'id');
    }

    // ASESOR

    /**
     * Menghitung persentase progress campaign.
     */
    public function getProgressAttribute(): int
    {
        // Menghitung jumlah slot yang sudah terisi
        $filledSlots = $this->total_slots - $this->slots_left;

        // Mengembalikan persentase progress
        return $this->total_slots > 0
            ? round(($filledSlots / $this->total_slots) * 100)
            : 0;
    }

    /**
     * Menentukan warna progress bar campaign.
     */
    public function getProgressColorAttribute(): string
    {
        if ($this->progress >= 80) {
            return '#22c55e'; // Hijau
        }

        if ($this->progress >= 50) {
            return '#eab308'; // Kuning
        }

        return '#e11d48'; // Merah
    }
}
