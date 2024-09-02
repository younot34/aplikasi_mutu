<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rmri extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'no_rm',
        'resume_ada',
        'resume_tidakAda',
        'resume_lengkap',
        'resume_tidak',
        'pengantar_ada',
        'pengantar_tidakAda',
        'pengantar_lengkap',
        'pengantar_tidak',
        'cppt_ada',
        'cppt_tidakAda',
        'cppt_lengkap',
        'cppt_tidak',
        'general_ada',
        'general_tidakAda',
        'general_lengkap',
        'general_tidak',
        'informed_ada',
        'informed_tidakAda',
        'informed_lengkap',
        'informed_tidak',
        'keterangan_lengkap',
    ];
}

