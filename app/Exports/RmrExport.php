<?php
namespace App\Exports;

use App\Models\Rmr;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RmrExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $bulan;

    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }

    public function collection()
    {
        return Rmr::select('tanggal', 'no', 'no_rm', 'asesmen', 'cppt', 'resep', 'resume', 'lengkap', 'tidak')
            ->whereMonth('tanggal', '=', date('m', strtotime($this->bulan)))
            ->whereYear('tanggal', '=', date('Y', strtotime($this->bulan)))
            ->get();
    }

    public function headings(): array
    {
        return [
            'tanggal',
            'no',
            'no_rm',
            'asesmen',
            'cppt',
            'resep',
            'resume',
            'lengkap',
            'tidak',
        ];
    }
}
