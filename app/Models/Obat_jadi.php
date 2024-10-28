<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat_jadi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal', 'nama_pasien', 'resep_masuk','resep_diserahkan','waktu_pelayanan'
    ];
}
