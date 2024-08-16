<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ri extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'sift',
        'no_rm',
        'nama_px',
        'alamat'
    ];

    public function pobats()
    {
        return $this->hasMany(Pobat::class);
    }
    public function pdarahs()
    {
        return $this->hasMany(Pdarah::class);
    }
    public function psamples()
    {
        return $this->hasMany(Psample::class);
    }
    public function ptindakans()
    {
        return $this->hasMany(Ptindakan::class);
    }
}
