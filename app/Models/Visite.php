<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    use HasFactory;

    protected $fillable =[
        'tanggal',
        'no_rm',
        'nama_px',
        'jam6sampai14',
        'kurang14',
        'dokter_spesial'
    ];
}
