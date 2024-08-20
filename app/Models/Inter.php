<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inter extends Model
{
    use HasFactory;
    protected $fillable=[
        'tanggal',
        'no_rm',
        'nama_pasien',
        'terisi',
        'tidak_terisi'
    ];
}
