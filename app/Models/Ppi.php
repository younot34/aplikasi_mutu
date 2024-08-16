<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppi extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'unit',
        'tanggal',
        'observer'
    ];

    public function profesis()
    {
        return $this->hasMany(Profesi::class);
    }
    public function indikasis()
    {
        return $this->hasMany(Indikasi::class);
    }
}
