<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radio extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'tanggal',
        'no_ro',
        'nama_pasien',
        'no_rm',
        'ruangan',
        'umur',
        'jenis_pembayaran',
        'dokter_pengirim',
        'jenis_pemeriksaan',
        'petugas',
        'kvmas',
        'jumlah_foto',
        'mulai',
        'selesai',
        'tarif',
        'keterangan'
    ];
}
