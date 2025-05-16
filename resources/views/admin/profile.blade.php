@extends('layouts.admin')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-100 via-white to-green-50 p-6">
    <div class="w-full max-w-2xl bg-white shadow-2xl rounded-2xl p-8">
        <h2 class="text-3xl font-bold text-center text-green-700 mb-8 flex items-center justify-center gap-2">
            <i data-lucide="user-cog" class="w-8 h-8 text-green-600"></i>
            Edit Profil
        </h2>

        @if(session('success'))
            <p class="text-center text-green-600 font-semibold mt-6">{{ session('success') }}</p>
        @endif

        <!-- Form Edit Profil -->
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="username" class="block mb-1 text-gray-700 font-semibold">Username</label>
                <div class="relative">
                    <i data-lucide="user" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                    <input type="text" name="username" id="username" value="{{ auth()->user()->username }}" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400 transition">
                </div>
            </div>

            <div class="mb-4">
                <label for="email" class="block mb-1 text-gray-700 font-semibold">Email</label>
                <div class="relative">
                    <i data-lucide="mail" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                    <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400 transition">
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="block mb-1 text-gray-700 font-semibold">Password Baru</label>
                <div class="relative">
                    <i data-lucide="lock" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                    <input type="password" name="password" id="password" placeholder="Isi jika ingin ubah password" class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-400 transition">
                </div>
            </div>

            <button type="submit" class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-full shadow-lg transition duration-300 ease-in-out">
                <i data-lucide="save" class="w-5 h-5"></i> Simpan
            </button>
        </form>

        <!-- Upload Foto Profil -->
        <form method="POST" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data" class="mt-6">
            @csrf
            <div class="mb-4">
                <label for="photo" class="block mb-1 text-gray-700 font-semibold">Foto Profil</label>
                <div class="relative">
                    <i data-lucide="image" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5"></i>
                    <input type="file" name="photo" id="photo" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg">
                </div>
            </div>
            <button type="submit" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-full shadow-lg transition duration-300 ease-in-out">
                <i data-lucide="upload" class="w-5 h-5"></i> Unggah Foto
            </button>
        </form>

        <hr class="my-6">

        <!-- Form Hapus Akun -->
        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="flex items-center gap-2 text-red-600 hover:text-red-700" onclick="return confirm('Yakin hapus akun?')">
                <i data-lucide="user-x" class="w-5 h-5"></i> Hapus Akun
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
@endpush
@endsection
