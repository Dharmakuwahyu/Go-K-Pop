<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    protected $table = 'albums';
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
}
