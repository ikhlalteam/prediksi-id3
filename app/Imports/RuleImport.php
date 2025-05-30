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

        // Sesuaikan nama kolom dengan format heading Laravel Excel (lowercase + underscore)
        $luasLahan = $rowData['luas_lahan'] ?? null;
        $jenisLahan = $rowData['jenis_lahan'] ?? null;
        $jenisBibit = $rowData['jenis_bibit'] ?? null;
        $cuaca = $rowData['cuaca'] ?? null;
        $lamaBertani = $rowData['lama_bertani'] ?? null;
        $jenisPupuk = $rowData['hasil_prediksi'] ?? null;

        // Simpan hanya jika semua data tersedia
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

    // Getter untuk mengambil data dari luar
    public function getData(): array
    {
        return $this->data;
    }
}

