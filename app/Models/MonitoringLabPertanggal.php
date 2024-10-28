<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringLabPertanggal extends Model
{
    use HasFactory;

    protected $fillable = [
        'monitoring_lab_id',
        'tanggal',
        'data_pertanggal_1',
        'data_pertanggal_2',
        'data_pertanggal_3',
        'data_pertanggal_4',
        'data_pertanggal_5',
        'data_pertanggal_6',
    ];

    public function monitoring_labs()
    {
        return $this->belongsTo(MonitoringLab::class);
    }
}
