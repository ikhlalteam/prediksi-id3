@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto">
    <h2 class="text-2xl font-bold text-green-700 mb-4">Hasil Perhitungan ID3</h2>

    <!-- Tabel Entropy & Gain -->
    <div class="bg-white shadow p-4 rounded mb-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-3">Entropy & Gain Tiap Atribut</h3>
        <table class="w-full text-sm text-left border border-gray-200">
            <thead class="bg-gray-100 font-semibold text-gray-700">
                <tr>
                    <th class="border px-4 py-2">Atribut</th>
                    <th class="border px-4 py-2">Entropy</th>
                    <th class="border px-4 py-2">Gain</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($gains as $attribute => $values)
                <tr>
                    <td class="border px-4 py-2">{{ $attribute }}</td>
                    <td class="border px-4 py-2">{{ $values['entropy'] }}</td>
                    <td class="border px-4 py-2">{{ $values['gain'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Visualisasi Pohon Keputusan -->
    <div class="bg-white shadow p-4 rounded mb-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-3">Visualisasi Pohon Keputusan (ID3)</h3>
        <div class="ml-4">
            @include('admin.rules.tree', ['node' => $tree])
        </div>
    </div>

    <!-- Tombol Simpan ke Riwayat -->
    <form action="{{ route('admin.rules.saveHistory') }}" method="POST" class="text-right">
        @csrf
        <input type="hidden" name="tree" value="{{ json_encode($tree) }}">
        <input type="hidden" name="gains" value="{{ json_encode($gains) }}">
        <button type="submit"
            class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded">
            Simpan ke Riwayat Perhitungan
        </button>
    </form>
</div>
@endsection

