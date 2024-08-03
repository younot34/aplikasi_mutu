<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imprs extends Model
{
    use HasFactory;

    protected $fillable = [
        'waktu'
    ];

    public function reseps()
    {
        return $this->hasMany(Resep::class);
    }
}
