<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pobat extends Model
{
    use HasFactory;

    protected $fillable = [
        'ri_id',
        'benar_namao',
        'benar_alamato'
    ];
    public function ris()
    {
        return $this->belongsTo(Ri::class);
    }
}
