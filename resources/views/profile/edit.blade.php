@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-100 via-white to-green-50 p-6">
    <div class="w-full max-w-2xl bg-white shadow-2xl rounded-2xl p-8">
        <h2 class="text-3xl font-bold text-center text-green-700 mb-8">✏️ Edit Profil</h2>

        @if(session('success'))
            <p class="text-center text-green-600 font-semibold mt-6">{{ session('success') }}</p>
        @endif

        <!-- ✅ Form Edit Profil -->
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block mb-1 text-gray-700 font-semibold">Email</label>
                <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400 transition">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block mb-1 text-gray-700 font-semibold">Password Baru</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400 transition" placeholder="Isi jika ingin ubah password">
            </div>

            <!-- Foto Profil -->
            <div class="mb-6">
                <label for="photo" class="block mb-1 text-gray-700 font-semibold">Foto Profil</label>
                <input type="file" name="photo" id="photo" accept="image/*" onchange="previewPhoto(event)" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                <div class="mt-3">
                    <p class="text-sm text-gray-500 mb-1">Preview:</p>
                    <img
                        id="preview-image"
                        src="{{ auth()->user()->profile_photo_path
                            ? asset('storage/' . auth()->user()->profile_photo_path)
                            : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->username) }}"
                        class="h-16 w-16 rounded-full object-cover border shadow"
                    >
                </div>
            </div>

            <!-- Tombol Simpan & Hapus Akun -->
            <div class="flex flex-col sm:flex-row sm:justify-between gap-4">
                <!-- Tombol Simpan -->
                <button type="submit"
                    style="background-color: #2563eb !important; color: white !important;"
                    class="w-full px-5 py-2 rounded-lg text-center">
                    Simpan
                </button>

                <!-- Tombol Hapus Akun -->
                <form method="POST" action="{{ route('profile.destroy') }}" class="w-full">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        style="background-color: #dc2626 !important; color: white !important;"
                        class="w-full px-5 py-2 rounded-lg text-center">
                        Hapus Akun
                    </button>
                </form>
            </div>
        </form>

        <!-- Riwayat -->
        <hr class="my-6">
        <h3 class="text-xl font-bold text-gray-800 mb-3">📜 Riwayat Prediksi:</h3>
        @if($riwayat->isEmpty())
            <p class="text-gray-500">Belum ada riwayat prediksi.</p>
        @else
            <ul class="list-disc list-inside text-gray-600 space-y-1">
                @foreach($riwayat as $r)
                    <li>
                        <span class="text-sm text-gray-500">{{ $r->created_at }}</span> — 
                        <strong>{{ $r->hasil_prediksi }}</strong>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewPhoto(event) {
        const input = event.target;
        const reader = new FileReader();
        reader.onload = function () {
            const img = document.getElementById('preview-image');
            img.src = reader.result;
        };
        if (input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush


       