<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AlbumVariant extends Model
{
    protected $table = 'album_variants';
    public $timestamps = false;
 
    protected $fillable = [
        'album_id',
        'name',
    ];
 
    // ============================================================
    // RELASI
    // ============================================================
 
    /**
     * Album induk dari varian ini.
     */
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class, 'album_id', 'id');
    }
 
    /**
     * Pesanan yang memilih varian ini.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'variant_id', 'id');
    }
}
