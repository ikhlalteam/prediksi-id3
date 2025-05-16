<?php

namespace App\Http\Controllers;

use App\Models\Prediksi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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
            $request->jenis_lahan
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

    public function destroy($id)
    {
        Prediksi::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function importId3(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls'
        ]);

        $data = Excel::toArray([], $request->file('excel_file'))[0];

        $header = array_map('strtolower', $data[0]);
        $rows = array_slice($data, 1);

        $dataset = [];
        foreach ($rows as $row) {
            $item = [];
            foreach ($header as $i => $key) {
                $item[$key] = $row[$i];
            }
            $dataset[] = $item;
        }

        $tree = $this->buildId3Tree($dataset, array_keys($dataset[0]), 'hasil_prediksi');

        \DB::table('id3_rules')->updateOrInsert(
            ['id' => 1],
            ['rule' => json_encode($tree), 'updated_at' => now()]
        );

        return back()->with('success', 'Rules ID3 berhasil dibuat dan disimpan!');
    }

    private function buildId3Tree($data, $attributes, $target)
    {
        // Placeholder / fungsi ID3 buildTree bisa Anda sesuaikan sesuai kebutuhan
        return []; // Untuk sementara return array kosong
    }
}
