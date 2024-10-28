<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringLab extends Model
{
    use HasFactory;

    protected $fillable = [
        'variabel',
        'sub_variabel_1',
        'sub_variabel_2',
        'sasaran',
        'total_1',
        'total_2',
        'hasil', // sesuaikan dengan kolom yang relevan
    ];

    public function monitoring_lab_pertanggals()
    {
        return $this->hasMany(MonitoringLabPertanggal::class);
    }
}
