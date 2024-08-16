<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oks extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'nama_pasien',
        'no_rm',
        'diagnosa',
        'nama_dokter',
        'tanggal',
        'waktu_masuk',
        'waktu_pelaksanaan',
        'waktu_pending',
        'alasan',
    ];

}
