<?php

namespace App\Http\Controllers;

use App\Models\Prediksi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RuleImport;

class AdminController extends Controller
{
    public function profile()
    {
        $riwayat = Prediksi::where('user_id', auth()->id())->latest()->get();
        return view('admin.profile', compact('riwayat'));
    }

    public function index()
    {
        $data = Prediksi::with('user')->latest()->get();
        return view('admin.dashboard', compact('data'));
    }

    public function edit($id)
    {
        $item = Prediksi::findOrFail($id);
        return view('admin.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Prediksi::findOrFail($id);

        $hasil = $this->prediksiID3(
            $request->jenis_bibit,
            $request->cuaca,
            $request->luas_lahan,
            $request->jenis_lahan,
            $request->lama_bertani
        );

        $item->update([
            'luas_lahan' => $request->luas_lahan,
            'jenis_lahan' => $request->jenis_lahan,
            'jenis_bibit' => $request->jenis_bibit,
            'cuaca' => $request->cuaca,
            'lama_bertani' => $request->lama_bertani,
            'hasil_prediksi' => $hasil,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Prediksi berhasil diperbarui.');
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

    public function destroy($id)
    {
        Prediksi::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function importRules(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:20480',
        ]);

        try {
            $import = new RuleImport;
            Excel::import($import, $request->file('file'));

            $dataset = $import->data;

            if (empty($dataset)) {
                return back()->with('error', 'Data Excel kosong atau format salah.');
            }

            
            $rules = $this->generateId3Rules($dataset); 

            return view('admin.rules.preview', compact('rules'));

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat upload: ' . $e->getMessage());
        }
    }

    
    private function generateId3Rules(array $dataset)
    {
        
        return [
            'Aturan ID3 belum dihitung. Ini hanya contoh.',
            'Total data: ' . count($dataset),
        ];
    }
}
