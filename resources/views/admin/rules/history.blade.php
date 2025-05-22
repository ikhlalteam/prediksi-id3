@extends('layouts.admin')

@section('content')
<h2 class="text-xl font-bold mb-4">Riwayat Perhitungan ID3</h2>

@foreach($histories as $history)
    <div class="bg-white p-4 shadow mb-4 rounded">
        <h4 class="text-lg font-bold">Perhitungan pada {{ $history->created_at->format('d M Y H:i') }}</h4>

        @php
            $entropyGain = json_decode($history->entropy_gain, true);
        @endphp

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
                    <td class="border px-2 py-1">{{ $values['entropy'] }}</td>
                    <td class="border px-2 py-1">{{ $values['gain'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endforeach

@endsection
