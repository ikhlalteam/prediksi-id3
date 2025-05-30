@extends('layouts.admin')

@section('content')
<h2 class="text-xl font-bold mb-4">Riwayat pohon id3</h2>


@php
    $gains = json_decode($history->entropy_gain, true);
@endphp

@if ($gains)
    <ul class="mb-6 list-disc list-inside">
        @foreach($gains as $attr => $value)
            <li><strong>{{ $attr }}</strong>: Gain = {{ $value['gain'] ?? '-' }}, Entropy = {{ $value['entropy'] ?? '-' }}</li>
        @endforeach
    </ul>
@else
    
@endif

<h3 class="font-semibold text-lg mb-2">Visualisasi Pohon Keputusan:</h3>
<pre class="bg-gray-100 p-4 rounded text-sm overflow-x-auto">
{{ json_encode(json_decode($history->decision_tree), JSON_PRETTY_PRINT) }}
</pre>



    <form method="POST" action="{{ route('admin.rules.cancel') }}">
        @csrf
        <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            kembali
        </button>
    </form>
</div>
@endsection

