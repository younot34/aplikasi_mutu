<?php
namespace App\Exports;

use App\Models\Farmasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class FarmasiExport implements FromCollection, WithHeadings, WithMapping, WithEvents
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
        return Farmasi::with('obats','nama_obats')
                      ->whereYear('waktu', $tahun)
                      ->whereMonth('waktu', $bulan)
                      ->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'No',
            'Nama Pasien',
            'No RM',
            'R/',
            'Nama Obat',
            'Total Obat Fornas',
            'Total Item',
        ];
    }

    public function map($farmasi): array
    {
        $rows = [];
        foreach ($farmasi->obats as $index => $obat) {
            // Menggabungkan nama obat dengan ID yang sama
            $namaObat = $farmasi->nama_obats->pluck('nama_obat')->implode(",");
            $rObat = $farmasi->nama_obats->pluck('r')->implode(",");

            $rows[] = [
                $index == 0 ? date('d/m/Y', strtotime($farmasi->waktu)) : '',
                $index == 0 ? $farmasi->id : '',
                $index == 0 ? $farmasi->nama_px : '',
                $index == 0 ? $farmasi->no_rm : '',
                $rObat,
                $namaObat,
                (int)$obat->total_obat_fornas,
                (int)$obat->total_item,
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

                // Pastikan kolom F dan G berisi data numerik
                for ($row = 2; $row <= $lastRow; $row++) {
                    $valueG = $sheet->getCell('G' . $row)->getValue();
                    $valueH = $sheet->getCell('H' . $row)->getValue();

                    // Konversi nilai ke numerik jika diperlukan
                    if (!is_numeric($valueG)) {
                        $valueG = (int)$valueG;
                        $sheet->setCellValueExplicit('G' . $row, $valueG, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                    }
                    if (!is_numeric($valueH)) {
                        $valueH = (int)$valueH;
                        $sheet->setCellValueExplicit('H' . $row, $valueH, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                    }
                }

                // Tambahkan baris jumlah
                $sheet->fromArray([
                    ['', '', '', '', '', 'JUMLAH',
                    '=SUM(G2:G' . $lastRow . ')',
                    '=SUM(H2:H' . $lastRow . ')']
                ], NULL, 'A' . ($lastRow + 1));
            },
        ];
    }
}
