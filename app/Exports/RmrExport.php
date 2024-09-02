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
        // Ambil data berdasarkan bulan dan tahun yang dipilih
        $data = Rmr::whereMonth('tanggal', '=', date('m', strtotime($this->bulan)))
            ->whereYear('tanggal', '=', date('Y', strtotime($this->bulan)))
            ->get();

        // Array untuk menyimpan hasil export
        $exportData = [];

        // Mengelompokkan data berdasarkan tanggal
        $groupedData = $data->groupBy('tanggal');

        foreach ($groupedData as $date => $items) {
            $jumlahLengkap = 0;
            $jumlahTidak = 0;

            foreach ($items as $item) {
                // Hitung jumlah lengkap dan tidak
                $jumlahLengkap += (
                    ($item->lengkap === '✔️' ? 1 : 0)
                );

                $jumlahTidak += (
                    ($item->tidak === '✔️' ? 1 : 0)
                );
            }

            // Hitung jumlah berkas
            $jumlahBerkas = $jumlahLengkap + $jumlahTidak;

            // Tambahkan data ke array export
            $exportData[] = [
                'tanggal' => $date,
                'jumlah_berkas' => $jumlahBerkas,
                'jumlah_lengkap' => $jumlahLengkap,
                'jumlah_tidak' => $jumlahTidak,
            ];
        }

        return collect($exportData);
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Jumlah Berkas',
            'Jumlah Lengkap',
            'Jumlah Tidak',
        ];
    }
}
