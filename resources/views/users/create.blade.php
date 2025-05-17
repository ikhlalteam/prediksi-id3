@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Tambah Pengguna Baru</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label for="email" class="block font-semibold">Email</label>
            <input type="email" name="email" id="email" class="w-full border px-4 py-2 rounded" value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="password" class="block font-semibold">Password</label>
            <input type="password" name="password" id="password" class="w-full border px-4 py-2 rounded" required>
        </div>

        <div>
            <label for="profile_photo" class="block font-semibold">Foto Profil (opsional)</label>
            <input type="file" name="profile_photo" id="profile_photo" class="w-full">
        </div>

        <div>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Simpan</button>
            <a href="{{ route('admin.users.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection


