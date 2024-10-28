<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiKritisLab extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'no_rm',
        'nama_pasien',
        'unit_asal',
        'dokter_pengirim',
        'jenis_pelayanan',
        'waktu_sampling',
        'waktu_selsai',
        'waktu_diterima',
        'selisih_waktu',
        'hasil_pemeriksaan_nilai_kritis',
        'pemberi_informasi',
        'penerima_informasi',
    ];
}
