<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plebititanggal extends Model
{
    use HasFactory;

    protected $fillable = [
        'plebiti_id', 'tanggal', 'data_pertanggal_1', 'data_pertanggal_2', // sesuaikan dengan kolom yang relevan
    ];

    public function plebitis()
    {
        return $this->belongsTo(Plebiti::class);
    }
}
