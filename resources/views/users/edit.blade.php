@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Edit Pengguna</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="email" class="block font-semibold">Email</label>
            <input type="email" name="email" id="email" class="w-full border px-4 py-2 rounded" value="{{ old('email', $user->email) }}" required>
        </div>

        <div>
            <label for="password" class="block font-semibold">Password Baru (kosongkan jika tidak diubah)</label>
            <input type="password" name="password" id="password" class="w-full border px-4 py-2 rounded">
        </div>

        <div>
            <label for="profile_photo" class="block font-semibold">Foto Profil Baru (opsional)</label>
            <input type="file" name="profile_photo" id="profile_photo" class="w-full">
        </div>

        @if($user->profile_photo_path)
            <div>
                <p class="font-semibold">Foto Saat Ini:</p>
                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" class="h-16 w-16 rounded-full object-cover mt-2">
            </div>
        @endif

        <div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Perbarui</button>
            <a href="{{ route('admin.users.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
