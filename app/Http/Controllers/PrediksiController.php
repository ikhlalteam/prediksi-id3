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
            $validated['luas_lahan'],
            $validated['jenis_lahan'],
            $validated['lama_bertani']
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

    private function prediksiID3($jenis_bibit, $cuaca, $luas_lahan, $jenis_lahan, $lama_bertani)
    {
        if ($jenis_bibit === 'Bagus') {
            if ($cuaca === 'Hujan') {
                if ($luas_lahan === 'Luas' && $jenis_lahan === 'Kering' && $lama_bertani === 'Lama') {
                    return '1 urea, 1 phoska';
                } elseif ($luas_lahan === 'Sedang' && $jenis_lahan === 'Kering' && $lama_bertani === 'Sedang') {
                    return '2 urea, 2 phoska';
                }
            } elseif ($cuaca === 'Normal') {
                if ($luas_lahan === 'Luas' && $jenis_lahan === 'Kering' && $lama_bertani === 'Baru') {
                    return '4 urea, 3 phoska';
                } elseif ($luas_lahan === 'Kecil' && $jenis_lahan === 'Kering' && $lama_bertani === 'Baru') {
                    return '4 urea, 3 phoska';
                }
            }
        } elseif ($jenis_bibit === 'Sedang') {
            if ($cuaca === 'Normal' && $luas_lahan === 'Luas' && $jenis_lahan === 'Kering' && $lama_bertani === 'Lama') {
                return '4 urea, 3 phoska';
            }
        } elseif ($jenis_bibit === 'Kurang') {
            if ($cuaca === 'Hujan' && $luas_lahan === 'Sedang' && $jenis_lahan === 'Pasir' && $lama_bertani === 'Sedang') {
                return '1 urea, 1 phoska';
            }
        }

        return '2 urea, 2 phoska'; 
    }


}
