<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ptindakan extends Model
{
    use HasFactory;

    protected $fillable = [
        'ri_id',
        'benar_namat',
        'benar_alamatt'
    ];
    public function ris()
    {
        return $this->belongsTo(Ri::class);
    }
}
