<?php

namespace App\Imports;

use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RuleImport implements OnEachRow, WithHeadingRow
{
    public array $data = [];

    public function onRow(Row $row): void
    {
        $rowData = $row->toArray();

        $luasLahan = $rowData['luas lahan'] ?? null;
        $jenisLahan = $rowData['jenis lahan'] ?? null;
        $jenisBibit = $rowData['jenis bibit'] ?? null;
        $cuaca = $rowData['cuaca'] ?? null;
        $lamaBertani = $rowData['lama bertani'] ?? null;
        $jenisPupuk = $rowData['hasil prediksi'] ?? null;

        if ($luasLahan && $jenisLahan && $jenisBibit && $cuaca && $lamaBertani && $jenisPupuk) {
            $this->data[] = [
                'Luas Lahan' => trim($luasLahan),
                'Jenis Lahan' => trim($jenisLahan),
                'Jenis Bibit' => trim($jenisBibit),
                'Cuaca' => trim($cuaca),
                'Lama Bertani' => trim($lamaBertani),
                'Jenis Pupuk' => trim($jenisPupuk),
            ];
        }
    }
}
