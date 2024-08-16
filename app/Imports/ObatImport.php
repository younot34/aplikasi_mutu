<?php

namespace App\Imports;

use App\Models\listobat;
use Maatwebsite\Excel\Concerns\ToModel;

class ObatImport implements ToModel
{
    public function model(array $row)
    {
        return new listobat([
            'list_obat' => $row[0], // Sesuaikan dengan kolom di file Excel
        ]);
    }
}
