<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SortingSession extends Model
{
    protected $table = 'sorting_sessions';

    public $timestamps = false;

    protected $fillable = [
        'album_id',
        'title',
        'status',
        'created_by',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    // ============================================================
    // RELASI
    // ============================================================

    /**
     * Album yang disortir di sesi ini.
     */
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class, 'album_id', 'id');
    }

    /**
     * Admin pembuat sesi sortir ini.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'created_by', 'id');
    }

    /**
     * Hasil sortir dari sesi ini.
     */
    public function results(): HasMany
    {
        return $this->hasMany(SortingResult::class, 'session_id', 'id');
    }
}
