<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pdarah extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'ri_id',
        'benar_namad',
        'benar_alamatd'
    ];
    public function ris()
    {
        return $this->belongsTo(Ri::class);
    }
}
