<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idotanggal extends Model
{
    use HasFactory;

    protected $fillable = [
        'ido_id', 'tanggal', 'data_pertanggal_1', 'data_pertanggal_2', // sesuaikan dengan kolom yang relevan
    ];

    public function idos()
    {
        return $this->belongsTo(Ido::class);
    }
}
