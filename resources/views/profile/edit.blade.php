@extends('layouts.app')
@section('content')

<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="max-w-xl mx-auto p-6 bg-white rounded-xl shadow-md">
    @csrf
    @method('PUT')

    <h2 class="text-2xl font-semibold mb-4">Edit Profil</h2>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Email --}}
    <div class="mb-4">
        <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('email')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    {{-- Password (opsional) --}}
    <div class="mb-4">
        <label for="password" class="block font-medium text-sm text-gray-700">Password Baru (opsional)</label>
        <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        @error('password')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror
    </div>

    {{-- Foto Profil --}}
    <div class="mb-4">
        <label for="photo" class="block font-medium text-sm text-gray-700">Foto Profil (opsional)</label>
        <input type="file" name="photo" id="photo" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        @error('photo')
            <div class="text-red-500 text-sm">{{ $message }}</div>
        @enderror

        @if(auth()->user()->profile_photo_path)
            <div class="mt-3">
                <p class="text-sm text-gray-600">Foto saat ini:</p>
                <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Foto Profil" class="w-24 h-24 rounded-full object-cover mt-1 border">
            </div>
        @endif
    </div>

    {{-- Tombol Submit --}}
    <div class="flex justify-end">
        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-blue-700 transition">
            Simpan Perubahan
        </button>
    </div>
</form>

@endsection