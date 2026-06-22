<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    protected $table = 'profiles';
 
    protected $fillable = [
        'user_id',
        'full_name',
        'phone',
        'address',
        'city',
    ];
 
    // ============================================================
    // RELASI
    // ============================================================

    /**
     * User pemilik profile ini (tabel users bawaan Laravel).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
 
    /**
     * Role user ini (admin / member).
     */
    public function role(): HasOne
    {
        return $this->hasOne(UserRole::class, 'user_id', 'id');
    }
 
    /**
     * Campaign yang dibuat oleh admin ini.
     */
    public function albums(): HasMany
    {
        return $this->hasMany(Album::class, 'created_by', 'id');
    }
 
    /**
     * Pesanan milik member ini.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }
 
    /**
     * Wishlist milik member ini.
     */
    public function wishlists(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'user_id', 'id');
    }
 
    /**
     * Pembayaran yang diverifikasi oleh admin ini.
     */
    public function verifiedPayments(): HasMany
    {
        return $this->hasMany(Payment::class, 'verified_by', 'id');
    }
}
