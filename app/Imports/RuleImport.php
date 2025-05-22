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
            // Pastikan semua kolom tersedia dan tidak kosong
            if (
                isset($row['luas_lahan'], $row['jenis_lahan'], $row['jenis_bibit'],
                       $row['cuaca'], $row['lama_bertani'], $row['hasil_prediksi'])
            ) {
                $this->data[] = [
                    'luas_lahan'    => $row['luas_lahan'],
                    'jenis_lahan'   => $row['jenis_lahan'],
                    'jenis_bibit'   => $row['jenis_bibit'],
                    'cuaca'         => $row['cuaca'],
                    'lama_bertani'  => $row['lama_bertani'],
                    'hasil_prediksi' => $row['hasil_prediksi'], // target label
                ];
            }
        }
    }
}
