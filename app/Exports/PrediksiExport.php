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
        return Prediksi::with('user')->latest()->get();
    }

    public function map($prediksi): array
    {
        return [
            $prediksi->id,
            $prediksi->user->email ?? '-',
            $prediksi->luas_lahan,
            $prediksi->jenis_lahan,
            $prediksi->jenis_bibit,
            $prediksi->cuaca,
            $prediksi->lama_bertani,
            $prediksi->hasil_prediksi,
            $prediksi->created_at->format('Y-m-d H:i:s'),
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Email User',
            'Luas Lahan',
            'Jenis Lahan',
            'Jenis Bibit',
            'Cuaca',
            'Lama Bertani',
            'Hasil Prediksi',
            'Tanggal',
        ];
    }
}
