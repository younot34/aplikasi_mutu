<?php
namespace App\Exports;

use App\Models\Oks;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OksExport implements FromCollection, WithHeadings
{
    protected $bulan;

    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }

    public function collection()
    {
        return Oks::with(['pasiens', 'dokters'])
            ->whereMonth('tanggal', '=', date('m', strtotime($this->bulan)))
            ->whereYear('tanggal', '=', date('Y', strtotime($this->bulan)))
            ->get();
    }

    public function headings(): array
    {
        return [
            'nama_pasien',
            'no_rm',
            'diagnosa',
            'nama_dokter',
            'tanggal',
            'waktu_pelaksanaan',
            'waktu_pending',
            'alasan',
        ];
    }
}
