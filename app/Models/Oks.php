<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oks extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'tanggal',
        'no_rm',
        'nama_pasien',
        'umur',
        'diagnosa',
        'tindakan_operasi',
        'dokter_op',
        'dokter_anest',
        'jenis_op',
        'asuransi',
        'rencana_tindakan',
        'signin',
        'time_out',
        'sign_out',
        'penandaan_lokasi_op',
        'kelengkapan_ssc',
        'penundaan_op_elektif',
        'penundaan_op_elektif1',
        'sc_emergensi1',
        'sc_emergensi',
        'keterangan',
        'kendala'
    ];

}
