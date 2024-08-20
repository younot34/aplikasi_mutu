<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dpjp extends Model
{
    use HasFactory;
    protected $fillable=[
        'tanggal',
        'no_rm',
        'nama_pasien',
        'terverifikasi',
        'tidak_terverifikasi',
        'dpjp'
    ];
}
