<?php

namespace App\Exports;

use App\Models\Rmri;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class RmriExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $bulan;

    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }

    public function collection()
    {
        // Ambil data berdasarkan bulan dan tahun yang dipilih
        $data = Rmri::whereMonth('tanggal', '=', date('m', strtotime($this->bulan)))
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
                    ($item->resume_lengkap === '✔️' ? 1 : 0) +
                    ($item->pengantar_lengkap === '✔️' ? 1 : 0) +
                    ($item->cppt_lengkap === '✔️' ? 1 : 0) +
                    ($item->general_lengkap === '✔️' ? 1 : 0) +
                    ($item->informed_lengkap === '✔️' ? 1 : 0)
                );

                $jumlahTidak += (
                    ($item->resume_tidak === '✔️' ? 1 : 0) +
                    ($item->pengantar_tidak === '✔️' ? 1 : 0) +
                    ($item->cppt_tidak === '✔️' ? 1 : 0) +
                    ($item->general_tidak === '✔️' ? 1 : 0) +
                    ($item->informed_tidak === '✔️' ? 1 : 0)
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
