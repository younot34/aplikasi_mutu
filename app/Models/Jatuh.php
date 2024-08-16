<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jatuh extends Model
{
    use HasFactory;

    protected $fillable=[
        'tanggal',
        'no_rm',
        'nama_px',
        'rendah',
        'tinggi',
        'kancing',
        'segitiga',
        'handreal'
    ];
}
