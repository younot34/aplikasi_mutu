<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesi extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'ppi_id',
        'profesi',
        'jumlah'
    ];
    public function ppis()
    {
        return $this->belongsTo(Ppi::class);
    }
}
