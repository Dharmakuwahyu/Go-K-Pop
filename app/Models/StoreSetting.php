<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreSetting extends Model
{
    // mengikuti aturan migration karena memakai
    // id selalu 1 — hanya ada 1 baris (singleton pattern)
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = true;
}
