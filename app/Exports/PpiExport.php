<?php
namespace App\Exports;

use App\Models\Ppi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PpiExport implements FromCollection, WithHeadings
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
        return Ppi::with(['profesis', 'indikasis'])
                    ->whereYear('tanggal', $tahun)
                    ->whereMonth('tanggal', $bulan)
                    ->get();
    }

    public function headings(): array
    {
        return [
            'no',
            'unit',
            'tanggal',
            'observer',
            'profesi',
            'jumlah',
            'opp',
            'indikasi',
            'cuci_tangan',
        ];
    }

    public function map($ppis): array
    {
        $rows = [];
        foreach ($ppis->profesis as $profesiss) {
            $opp = $ppis->indikasis->pluck('opp')->implode(",");
            $indiKasi = $ppis->indikasis->pluck('indikasi')->implode(",");
            $cuciTangan = $ppis->indikasis->pluck('cuci_tangan')->implode(",");

            $rows[] = [
                $ppis->id,
                $ppis->unit,
                date('d/m/Y', strtotime($ppis->tanggal)),
                $ppis->observer,
                $profesiss->profesi,
                $profesiss->jumlah,
                $opp,
                $indiKasi,
                $cuciTangan,
            ];
        }

        return $rows;
    }
}
