@extends('layouts.admin')

@section('content')
<h2 class="text-xl font-bold mb-4">Upload Data Excel</h2>

@if(session('error'))
    <div class="text-red-500">{{ session('error') }}</div>
@endif

<form action="{{ route('admin.rules.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
     <input type="file" name="excel_file" required>
    <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-green-600">
            lakukan perhitungan
        </button>
</form>


@endsection

