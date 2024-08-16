<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Psample extends Model
{
    use HasFactory;

    protected $fillable = [
        'ri_id',
        'benar_namas',
        'benar_alamats'
    ];
    public function ris()
    {
        return $this->belongsTo(Ri::class);
    }
}
