<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apd extends Model
{
    use HasFactory;

    protected $fillable=[
        'tanggal',
        'unit',
        'nama_petugas',
        'profesi',
        'tindakan',
        'topi',
        'kacamata',
        'masker',
        'gown',
        'sarung_tangan',
        'sepatu',
        'ya',
        'tidak',
        'keterangan'
    ];
}
