<?php

namespace App\Exports;

use App\Models\Prediksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PrediksiExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Prediksi::latest()->get(); // Tidak perlu load user jika tidak digunakan
    }

    public function map($prediksi): array
    {
        return [
            $prediksi->luas_lahan,
            $prediksi->jenis_lahan,
            $prediksi->jenis_bibit,
            $prediksi->cuaca,
            $prediksi->lama_bertani,
            $prediksi->hasil_prediksi,
        ];
    }

    public function headings(): array
    {
        return [
            'Luas Lahan',
            'Jenis Lahan',
            'Jenis Bibit',
            'Cuaca',
            'Lama Bertani',
            'Hasil Prediksi',
        ];
    }
}

