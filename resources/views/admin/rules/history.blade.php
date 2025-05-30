@extends('layouts.admin')

@section('content')
<h2 class="text-xl font-bold mb-4">Riwayat Perhitungan ID3</h2>

@foreach($histories as $history)

    <div class="bg-white p-4 shadow mb-4 rounded">
        <h4 class="text-lg font-bold">Perhitungan pada {{ \Carbon\Carbon::parse($history->created_at)->format('d M Y H:i') }}</h4>

        @php
            $entropyGain = json_decode($history->entropy_gain, true);
        @endphp

        @if (is_array($entropyGain))
            <table class="w-full text-sm mt-2 border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-2 py-1">Atribut</th>
                        <th class="border px-2 py-1">Entropy</th>
                        <th class="border px-2 py-1">Gain</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entropyGain as $attribute => $values)
                        <tr>
                            <td class="border px-2 py-1">{{ $attribute }}</td>
                            <td class="border px-2 py-1">{{ $values['entropy'] ?? '-' }}</td>
                            <td class="border px-2 py-1">{{ $values['gain'] ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            
        @endif

        {{-- Tombol Aksi --}}
        <div class="flex mt-4 gap-2">
            <form action="{{ route('admin.rules.preview') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $history->id }}">
                <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Lihat pohon id3 </button>
            </form>

            <form action="{{ route('admin.rules.delete', $history->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus riwayat ini?')">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</button>
            </form>
        </div>
    </div>
@endforeach
@endsection


