@extends('layouts.admin')

@section('content')
<h2 class="text-xl font-bold mb-4">Hasil Perhitungan ID3</h2>

<h3 class="font-semibold text-lg mb-2">Entropy dan Information Gain:</h3>
<ul class="mb-6 list-disc list-inside">
    @foreach($gains as $attr => $value)
        <li><strong>{{ $attr }}</strong>: Gain = {{ $value['gain'] }}, Entropy = {{ $value['entropy'] }}</li>
    @endforeach
</ul>

<h3 class="font-semibold text-lg mb-2">Visualisasi Pohon Keputusan:</h3>
<pre class="bg-gray-100 p-4 rounded text-sm overflow-x-auto">{{ json_encode($tree, JSON_PRETTY_PRINT) }}</pre>

<form method="POST" action="{{ route('admin.rules.saveToHistory') }}">
    @csrf
    <input type="hidden" name="tree_json" value="{{ json_encode($tree) }}">
    <input type="hidden" name="gain_info" value="{{ json_encode($gains) }}">
    <button type="submit" class="mt-4 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
        Simpan ke Riwayat
    </button>
</form>
@endsection
