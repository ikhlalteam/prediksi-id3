@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-100 via-white to-green-50 py-10 px-4">
    <div class="max-w-6xl mx-auto bg-white shadow-2xl rounded-2xl p-8">
        <h2 class="text-3xl font-bold text-center text-green-700 mb-8 flex justify-center items-center gap-2">
            <i data-lucide="leaf" class="w-8 h-8 text-green-600"></i>
            Form Hasil Prediksi Pupuk
        </h2>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-200 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto mb-6">
            <table class="min-w-full border border-gray-300 text-sm text-left">
                <thead class="bg-green-200 text-green-900">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">User</th>
                        <th class="px-4 py-2 border">Luas</th>
                        <th class="px-4 py-2 border">Jenis</th>
                        <th class="px-4 py-2 border">Cuaca</th>
                        <th class="px-4 py-2 border">Lama Bertani</th>
                        <th class="px-4 py-2 border">Prediksi</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $i => $row)
                        <tr class="hover:bg-green-50">
                            <td class="px-4 py-2 border">{{ $i+1 }}</td>
                            <td class="px-4 py-2 border">{{ $row->user->email ?? '-' }}</td>
                            <td class="px-4 py-2 border">{{ $row->luas_lahan }}</td>
                            <td class="px-4 py-2 border">{{ $row->jenis_lahan }}</td>
                            <td class="px-4 py-2 border">{{ $row->cuaca }}</td>
                            <td class="px-4 py-2 border">{{ $row->lama_bertani }}</td>
                            <td class="px-4 py-2 border">{{ $row->hasil_prediksi }}</td>
                            <td class="px-4 py-2 border">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.edit', $row->id) }}" class="flex items-center gap-1 text-blue-600 hover:underline">
                                        <i data-lucide="edit" class="w-4 h-4"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.delete', $row->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="flex items-center gap-1 text-red-600 hover:underline">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('admin.export') }}" class="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                <i data-lucide="file-down" class="w-5 h-5"></i> Cetak Excel
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    <i data-lucide="log-out" class="w-5 h-5"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Tambahkan script untuk aktifkan ikon -->
@push('scripts')
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
@endpush
@endsection
