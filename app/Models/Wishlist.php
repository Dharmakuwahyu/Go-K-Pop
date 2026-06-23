<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wishlist extends Model
{
    protected $table = 'wishlists';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'album_id',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    // ============================================================
    // RELASI
    // ============================================================

    /**
     * Member pemilik wishlist ini.
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'user_id', 'id');
    }

    /**
     * Album yang di-wishlist.
     */
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class, 'album_id', 'id');
    }
}
