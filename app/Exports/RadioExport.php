<?php
namespace App\Exports;

use App\Models\Radio;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RadioExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $bulan;

    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }

    public function collection()
    {
        return Radio::select(
            'tanggal',
            'no_ro',
            'nama_pasien',
            'no_rm',
            'ruangan',
            'umur',
            'jenis_pembayaran',
            'dokter_pengirim',
            'jenis_pemeriksaan',
            'petugas',
            'kvmas',
            'mulai',
            'selesai',
            'tarif',
            'keterangan'
        )
        ->whereMonth('tanggal', '=', date('m', strtotime($this->bulan)))
        ->whereYear('tanggal', '=', date('Y', strtotime($this->bulan)))
        ->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'No RO',
            'Nama Pasien',
            'No RM',
            'Ruangan',
            'Umur',
            'Jenis Pembayaran',
            'Dokter Pengirim',
            'Jenis Pemeriksaan',
            'Petugas',
            'KV/MAs',
            'Mulai',
            'Selesai',
            'Tarif',
            'Keterangan'
        ];
    }

}
