<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $fillable = [
        'imprs_id','resep_high_alert','resep_terverifikasi'
    ];

    public function imprs()
    {
        return $this->belongsTo(Imprs::class);
    }
}
