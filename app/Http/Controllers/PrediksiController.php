<?php

namespace App\Http\Controllers;

use App\Models\Prediksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrediksiController extends Controller
{
    public function index()
    {
        $riwayat = Prediksi::where('user_id', Auth::id())->latest()->get();
        return view('dashboard', compact('riwayat'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'luas_lahan' => 'required',
            'jenis_lahan' => 'required',
            'jenis_bibit' => 'required',
            'cuaca' => 'required',
            'lama_bertani' => 'required',
        ]);

        $hasil = $this->prediksiID3(
            $validated['jenis_bibit'],
            $validated['cuaca'],
            $validated['jenis_lahan']
        );

        Prediksi::create([
            'user_id' => Auth::id(),
            'luas_lahan' => $validated['luas_lahan'],
            'jenis_lahan' => $validated['jenis_lahan'],
            'jenis_bibit' => $validated['jenis_bibit'],
            'cuaca' => $validated['cuaca'],
            'lama_bertani' => $validated['lama_bertani'],
            'hasil_prediksi' => $hasil,
        ]);

        return redirect()->back()->with('success', 'Prediksi berhasil disimpan!');
    }

    private function prediksiID3($jenis_bibit, $cuaca, $jenis_lahan)
    {
        if ($jenis_bibit === 'Bagus') {
            if ($cuaca === 'Hujan') {
                return 'Tetap';
            } elseif ($cuaca === 'Normal') {
                return 'Naik atau Turun';
            }
        } elseif ($jenis_bibit === 'Sedang') {
            return 'Naik';
        } elseif ($jenis_bibit === 'Kurang') {
            if ($jenis_lahan === 'Kering') {
                return 'Tetap';
            } elseif ($jenis_lahan === 'Pasir') {
                return 'Turun';
            }
        }

        return 'Tidak diketahui';
    }
}
