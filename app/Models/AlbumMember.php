<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlbumMember extends Model
{
    protected $table = 'album_members';
    public $timestamps = false;
 
    protected $fillable = [
        'album_id',
        'name',
    ];
 
    // ============================================================
    // RELASI
    // ============================================================
 
    /**
     * Album induk dari member ini.
     */
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class, 'album_id', 'id');
    }
}
