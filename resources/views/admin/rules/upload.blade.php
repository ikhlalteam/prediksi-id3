@extends('layouts.admin')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-100 via-white to-green-50 p-6">
    <div class="w-full max-w-2xl bg-white shadow-2xl rounded-2xl p-8">
        <h2 class="text-3xl font-bold text-center text-green-700 mb-8">📊 Upload File Excel untuk Perhitungan ID3</h2>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded shadow">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form Upload Excel -->
        <form action="{{ route('admin.rules.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="file" class="block text-gray-700 font-semibold mb-2">Pilih file Excel (.xlsx)</label>
                <input type="file" name="file" id="file" accept=".xlsx" required
                       class="w-full border px-4 py-2 rounded-lg border-gray-300">
            </div>

            <div class="text-center">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-full shadow transition duration-200">
                    ⬆️ Upload & Hitung ID3
                </button>
            </div>
        </form>

        <!-- Keterangan -->
        <p class="text-gray-500 text-sm mt-4">* File harus memiliki format dan kolom yang sesuai dengan struktur data prediksi.</p>
    </div>
</div>
@endsection
