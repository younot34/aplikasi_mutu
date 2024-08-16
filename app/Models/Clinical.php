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
        'ca_cervik',
        'tb',
        'ht',
        'hiv',
        'dm',
        'masuk',
        'keluar'
    ];
}
