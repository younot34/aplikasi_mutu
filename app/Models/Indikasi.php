<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikasi extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'ppi_id',
        'opp',
        'indikasi',
        'cuci_tangan'
    ];
    public function ppis()
    {
        return $this->belongsTo(Ppi::class);
    }
}
