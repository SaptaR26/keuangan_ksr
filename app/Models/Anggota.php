<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $fillable = ['nama'];

    public function pembayaran()
    {
        return $this->hasMany(PembayaranKas::class, 'anggota_id');
    }
}
