<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nama_obat extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmasi_id','r','nama_obat'
    ];

    public function farmasi()
    {
        return $this->belongsTo(Farmasi::class);
    }
}
