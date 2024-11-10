<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinical extends Model
{
    use HasFactory;

    protected $fillable=[
        'no_rm',
        'nama_px',
        'diagnosa',
        'patuh',
        'masuk',
        'keluar'
    ];
}
