<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmasi_id', 'r', 'nama_obat', 'total_obat_fornas', 'total_item'
    ];

    public function farmasi()
    {
        return $this->belongsTo(Farmasi::class);
    }
}
