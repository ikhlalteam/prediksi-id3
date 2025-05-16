@extends('layouts.admin')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-yellow-100 via-white to-green-50 p-6">
    <div class="w-full max-w-2xl bg-white shadow-xl rounded-2xl p-8">
        <h2 class="text-3xl font-bold text-center text-green-700 mb-6">✏️ Edit Prediksi User</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.update', $item->id) }}">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Luas Lahan</label>
                <select name="luas_lahan" class="w-full border rounded px-4 py-2">
                    <option {{ $item->luas_lahan === 'Kecil' ? 'selected' : '' }}>Kecil</option>
                    <option {{ $item->luas_lahan === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                    <option {{ $item->luas_lahan === 'Luas' ? 'selected' : '' }}>Luas</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Jenis Lahan</label>
                <select name="jenis_lahan" class="w-full border rounded px-4 py-2">
                    <option {{ $item->jenis_lahan === 'Kering' ? 'selected' : '' }}>Kering</option>
                    <option {{ $item->jenis_lahan === 'Pasir' ? 'selected' : '' }}>Pasir</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Jenis Bibit</label>
                <select name="jenis_bibit" class="w-full border rounded px-4 py-2">
                    <option {{ $item->jenis_bibit === 'Bagus' ? 'selected' : '' }}>Bagus</option>
                    <option {{ $item->jenis_bibit === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                    <option {{ $item->jenis_bibit === 'Kurang' ? 'selected' : '' }}>Kurang</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Cuaca</label>
                <select name="cuaca" class="w-full border rounded px-4 py-2">
                    <option {{ $item->cuaca === 'Hujan' ? 'selected' : '' }}>Hujan</option>
                    <option {{ $item->cuaca === 'Normal' ? 'selected' : '' }}>Normal</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1 text-gray-700">Lama Bertani</label>
                <select name="lama_bertani" class="w-full border rounded px-4 py-2">
                    <option {{ $item->lama_bertani === 'Baru' ? 'selected' : '' }}>Baru</option>
                    <option {{ $item->lama_bertani === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                    <option {{ $item->lama_bertani === 'Lama' ? 'selected' : '' }}>Lama</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition duration-200">
                💾 Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection
