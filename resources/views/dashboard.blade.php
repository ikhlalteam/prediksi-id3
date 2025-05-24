@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center p-12">
    <div class="mx-auto w-full max-w-[600px] bg-white dark:bg-white-800 rounded-xl shadow-2xl p-8 sm:p-10">
        <h2 class="text-2xl font-bold text-center text-green-700 mb-8 flex items-center justify-center gap-2">
            <i data-lucide="leaf" class="w-6 h-6 text-green-700"></i> Form Prediksi Pupuk
        </h2>

        <form method="POST" action="{{ route('prediksi.store') }}">
            @csrf

            {{-- Luas Lahan --}}
            <div class="mb-5">
                <label class="flex items-center gap-2 text-base font-medium text-[#07074D] mb-2">
                    <i data-lucide="expand" class="w-5 h-5 text-green-700"></i> Luas Lahan
                </label>
                <select name="luas_lahan" class="w-full rounded-md border border-[#e0e0e0] py-3 px-4 text-base text-gray-700 outline-none focus:border-green-500 focus:shadow-md">
                    <option value="Kecil">Kecil (≤ 0,5 Ha)</option>
                    <option value="Sedang">Sedang (0,51 – 2 Ha)</option>
                    <option value="Luas">Luas (> 2 Ha)</option>
                </select>
                <small class="text-sm text-gray-500">Kecil: ≤ 0,5 Ha | Sedang: 0,51 – 2 Ha | Luas: > 2 Ha</small>
            </div>

            {{-- Jenis Lahan --}}
            <div class="mb-5">
                <label class="flex items-center gap-2 text-base font-medium text-[#07074D] mb-2">
                    <i data-lucide="land-plot" class="w-5 h-5 text-green-700"></i> Jenis Lahan
                </label>
                <select name="jenis_lahan" class="w-full rounded-md border border-[#e0e0e0] py-3 px-4 text-base text-gray-700 outline-none focus:border-green-500 focus:shadow-md">
                    <option value="Kering">Kering</option>
                    <option value="Pasir">Pasir</option>
                </select>
                <small class="text-sm text-gray-500">Pilih antara tanah kering atau berpasir</small>
            </div>

            {{-- Jenis Bibit --}}
            <div class="mb-5">
                <label class="flex items-center gap-2 text-base font-medium text-[#07074D] mb-2">
                    <i data-lucide="sprout" class="w-5 h-5 text-green-700"></i> Jenis Bibit
                </label>
                <select name="jenis_bibit" class="w-full rounded-md border border-[#e0e0e0] py-3 px-4 text-base text-gray-700 outline-none focus:border-green-500 focus:shadow-md">
                    <option value="Bagus">Bagus (Sumo, NP, Perkasa)</option>
                    <option value="Sedang">Sedang (Bisi 2)</option>
                    <option value="Kurang">Kurang (Bibit bantuan)</option>
                </select>
                <small class="text-sm text-gray-500">Bagus: Sumo, NP, Perkasa | Sedang: Bisi 2 | Kurang: Bibit bantuan</small>
            </div>

            {{-- Cuaca --}}
            <div class="mb-5">
                <label class="flex items-center gap-2 text-base font-medium text-[#07074D] mb-2">
                    <i data-lucide="cloud-sun" class="w-5 h-5 text-green-700"></i> Cuaca
                </label>
                <select name="cuaca" class="w-full rounded-md border border-[#e0e0e0] py-3 px-4 text-base text-gray-700 outline-none focus:border-green-500 focus:shadow-md">
                    <option value="Hujan">Hujan</option>
                    <option value="Normal">Normal</option>
                </select>
                <small class="text-sm text-gray-500">Cuaca saat ini di lahan</small>
            </div>

            {{-- Lama Bertani --}}
            <div class="mb-5">
                <label class="flex items-center gap-2 text-base font-medium text-[#07074D] mb-2">
                    <i data-lucide="hourglass" class="w-5 h-5 text-green-700"></i> Lama Bertani
                </label>
                <select name="lama_bertani" class="w-full rounded-md border border-[#e0e0e0] py-3 px-4 text-base text-gray-700 outline-none focus:border-green-500 focus:shadow-md">
                    <option value="Baru">Baru (1–5 tahun)</option>
                    <option value="Sedang">Sedang (6–10 tahun)</option>
                    <option value="Lama">Lama (> 10 tahun)</option>
                </select>
                <small class="text-sm text-gray-500">Baru: 1–5 tahun | Sedang: 6–10 tahun | Lama: > 10 tahun</small>
            </div>

            {{-- Submit --}}
            <div class="mt-6">
                <button type="submit"
                    onclick="return confirm('Apakah Anda yakin data sudah benar?')"
                    class="w-full flex items-center justify-center gap-2 rounded-md bg-red-600 py-2 px-6 text-white text-base font-semibold hover:bg-green-700 shadow-md transition duration-300 ease-in-out">
                    <i data-lucide="activity" class="w-5 h-5"></i> Prediksi Sekarang
                </button>
            </div>
        </form>

        {{-- Success message --}}
        @if(session('success'))
            <p class="text-center text-green-600 font-semibold mt-6">{{ session('success') }}</p>
        @endif

        {{-- Hasil prediksi terbaru --}}
        @if($riwayat->isNotEmpty())
            @php $terbaru = $riwayat->first(); @endphp
            <div class="mt-10 p-6 bg-green-50 border border-green-300 rounded-xl text-green-800 shadow-md">
                <h3 class="text-lg font-semibold mb-4 flex items-center gap-2 justify-center">
                    <i data-lucide="check-circle" class="w-5 h-5 text-green-700"></i> Hasil Prediksi Terbaru
                </h3>
                <div class="space-y-2 text-sm">
                    <p><strong>Luas Lahan:</strong> {{ $terbaru->luas_lahan }}</p>
                    <p><strong>Jenis Lahan:</strong> {{ $terbaru->jenis_lahan }}</p>
                    <p><strong>Jenis Bibit:</strong> {{ $terbaru->jenis_bibit }}</p>
                    <p><strong>Cuaca:</strong> {{ $terbaru->cuaca }}</p>
                    <p><strong>Lama Bertani:</strong> {{ $terbaru->lama_bertani }}</p>
                    <p><strong>Hasil Prediksi:</strong>
                        <span class="text-base font-semibold text-green-700">{{ $terbaru->hasil_prediksi }}</span>
                    </p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
