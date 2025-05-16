@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8 px-6">
    <h2 class="text-3xl font-bold text-green-700 mb-6 text-center">📜 Riwayat Prediksi Anda</h2>

    @if($riwayat->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md">
                <thead class="bg-green-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Tanggal</th>
                        <th class="py-3 px-4 text-left">Luas Lahan</th>
                        <th class="py-3 px-4 text-left">Jenis Lahan</th>
                        <th class="py-3 px-4 text-left">Jenis Bibit</th>
                        <th class="py-3 px-4 text-left">Cuaca</th>
                        <th class="py-3 px-4 text-left">Lama Bertani</th>
                        <th class="py-3 px-4 text-left">Hasil</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayat as $item)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-2 px-4">{{ $item->created_at->format('Y-m-d H:i') }}</td>
                        <td class="py-2 px-4">{{ $item->luas_lahan }}</td>
                        <td class="py-2 px-4">{{ $item->jenis_lahan }}</td>
                        <td class="py-2 px-4">{{ $item->jenis_bibit }}</td>
                        <td class="py-2 px-4">{{ $item->cuaca }}</td>
                        <td class="py-2 px-4">{{ $item->lama_bertani }}</td>
                        <td class="py-2 px-4 font-semibold">{{ $item->hasil_prediksi }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-center text-gray-500">Belum ada riwayat prediksi.</p>
    @endif
</div>
@endsection
