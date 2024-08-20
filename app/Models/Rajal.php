<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rajal extends Model
{
    use HasFactory;
    protected $fillable=[
        'tanggal',
        'poli',
        'patuh',
        'tidak_patuh'
    ];
}
