<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rmr extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'tanggal',
        'no',
        'no_rm',
        'asesmen',
        'cppt',
        'resep',
        'resume',
        'lengkap',
        'tidak',
    ];
}
