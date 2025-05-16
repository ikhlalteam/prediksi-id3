@extends('layouts.app')

@section('content')
<div class="shadow-lg rounded-lg overflow-hidden mx-4 md:mx-10">
    <h2 class="text-3xl font-bold text-green-700 mb-8 text-center mt-6">📜 Riwayat Prediksi Anda</h2>

    @if($riwayat->count() > 0)
        <table class="w-full table-fixed">
            <thead class="bg-red-100">
                <tr>
                    <th class="w-1/6 py-4 px-6 text-left text-gray-600 font-bold uppercase">Tanggal</th>
                    <th class="w-1/6 py-4 px-6 text-left text-gray-600 font-bold uppercase">Luas Lahan</th>
                    <th class="w-1/6 py-4 px-6 text-left text-gray-600 font-bold uppercase">Jenis Lahan</th>
                    <th class="w-1/6 py-4 px-6 text-left text-gray-600 font-bold uppercase">Jenis Bibit</th>
                    <th class="w-1/6 py-4 px-6 text-left text-gray-600 font-bold uppercase">Cuaca</th>
                    <th class="w-1/6 py-4 px-6 text-left text-gray-600 font-bold uppercase">Lama Bertani</th>
                    <th class="w-1/6 py-4 px-6 text-left text-gray-600 font-bold uppercase">Hasil</th>
                </tr>
            </thead>
            <tbody class="bg-red">
                @foreach($riwayat as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-4 px-6 border-b border-gray-200">{{ $item->created_at->format('Y-m-d H:i') }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ $item->luas_lahan }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ $item->jenis_lahan }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ $item->jenis_bibit }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ $item->cuaca }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ $item->lama_bertani }}</td>
                        <td class="py-4 px-6 border-b border-gray-200 font-bold text-green-700">{{ $item->hasil_prediksi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center text-gray-500 text-lg mt-6">Belum ada riwayat prediksi.</p>
    @endif
</div>

@endsection
