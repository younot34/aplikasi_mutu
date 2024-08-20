<?php
namespace App\Exports;

use App\Models\Oks;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OksExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $bulan;

    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }

    public function collection()
    {
        return Oks::select('tanggal', 'no_rm', 'nama_pasien', 'umur', 'diagnosa', 'tindakan_operasi', 'dokter_op', 'dokter_anest', 'jenis_op', 'asuransi', 'rencana_tindakan', 'signin', 'time_out', 'sign_out', 'penandaan_lokasi_op', 'kelengkapan_ssc', 'penundaan_op_elektif', 'sc_emergensi', 'keterangan', 'kendala')
            ->whereMonth('tanggal', '=', date('m', strtotime($this->bulan)))
            ->whereYear('tanggal', '=', date('Y', strtotime($this->bulan)))
            ->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'No RM',
            'Nama Pasien',
            'Umur',
            'Diagnosa',
            'Tindakan Operasi',
            'Dokter OP',
            'Dokter Anest',
            'Jenis OP',
            'Asuransi',
            'Rencana Tindakan',
            'Sign In',
            'Time Out',
            'Sign Out',
            'Penandaan Lokasi OP',
            'Kelengkapan SSC',
            'Penundaan OP Elektif',
            'SC Emergensi',
            'Keterangan',
            'Kendala'
        ];
    }
}
