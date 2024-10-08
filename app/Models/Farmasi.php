<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmasi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'waktu', 'nama_px','no_rm'
    ];

    public function obats()
    {
        return $this->hasMany(Obat::class);
    }
    public function nama_obats()
    {
        return $this->hasMany(nama_obat::class);
    }
}
