<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembayaranKas extends Model
{
    protected $table = 'pembayaran_kas';
    protected $fillable = ['anggota_id', 'tanggal_periode', 'apakah_bayar', 'kena_denda'];
}
