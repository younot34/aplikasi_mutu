<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ido extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 'variabel', 'sub_variabel_1', 'sub_variabel_2', 'sasaran', 'total_1', 'total_2', 'hasil', // sesuaikan dengan kolom yang relevan
    ];

    public function idotanggals()
    {
        return $this->hasMany(Idotanggal::class);
    }
}
