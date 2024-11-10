<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemberianObat extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal', 'nama_pasien', 'no_rm','keterangan','tidakSalah'
    ];
}
