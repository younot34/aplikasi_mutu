<?php
namespace App\Exports;

use App\Models\Imprs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ImprsExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $bulan;

    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }

    public function collection()
    {
        $bulan = date('m', strtotime($this->bulan));
        $tahun = date('Y', strtotime($this->bulan));
        return Imprs::with('reseps')
                    ->whereYear('waktu', $tahun)
                    ->whereMonth('waktu', $bulan)
                    ->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Resep Terverifikasi Double Check',
            'Resep High Alert',
        ];
    }

    public function map($imprs): array
    {
        $rows = [];
        foreach ($imprs->reseps as $resep) {
            $rows[] = [
                date('d/m/Y', strtotime($imprs->waktu)),
                $resep->resep_terverifikasi,
                $resep->resep_high_alert,
            ];
        }
        return $rows;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = $sheet->getHighestRow();

                // Tambahkan baris hasil akhir
                $sheet->fromArray([
                    ['', 'HASIL AKHIR', '=((SUM(B2:C' . $lastRow . ') - SUM(C2:B' . $lastRow . ')) * 100']
                ], NULL, 'A' . ($lastRow + 1));
            },
        ];
    }

}
