<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRole extends Model
{
    protected $table = 'user_roles';

    public $timestamps = false;

    protected $fillable = [
        'profile_id',
        'role',
    ];

    // ============================================================
    // RELASI
    // ============================================================

    /**
     * Profile pemilik role ini.
     * Catatan: kolom 'user_id' di tabel ini merujuk ke profiles.id
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }
}
