@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4 text-green-600">📚 Riwayat Perhitungan ID3</h2>

    @if ($riwayat->isEmpty())
        <p class="text-gray-500">Belum ada riwayat perhitungan.</p>
    @else
        <table class="table-auto w-full border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">#</th>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Jumlah Data</th>
                    <th class="px-4 py-2 border">Ringkasan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayat as $i => $r)
                    <tr>
                        <td class="border px-4 py-2">{{ $i+1 }}</td>
                        <td class="border px-4 py-2">{{ $r->created_at }}</td>
                        <td class="border px-4 py-2">{{ $r->jumlah_data }}</td>
                        <td class="border px-4 py-2">{{ $r->ringkasan ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

