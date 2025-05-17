<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RuleImport implements ToCollection, WithHeadingRow
{
    public $data = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Pastikan kolom sesuai Excel Anda
            $this->data[] = [
                'luas_lahan'    => $row['luas_lahan'],
                'jenis_lahan'   => $row['jenis_lahan'],
                'jenis_bibit'   => $row['jenis_bibit'],
                'cuaca'         => $row['cuaca'],
                'lama_bertani'  => $row['lama_bertani'],
                'jenis_pupuk'   => $row['hasil_prediksi'], // mapping target
            ];
        }
    }
}
