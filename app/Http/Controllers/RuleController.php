<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\RuleImport;
use App\Services\ID3Calculator;
use Maatwebsite\Excel\Facades\Excel;

class RuleController extends Controller
{
    public function history()
    {
        $histories = DB::table('rule_histories')->latest()->get();
        return view('admin.rules.history', compact('histories'));
    }

    public function uploadForm()
    {
        return view('admin.rules.upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        $import = new RuleImport();
        Excel::import($import, $request->file('excel_file'));
        $data = $import->data;

        if (empty($data)) {
            return back()->with('error', 'Data Excel kosong atau format salah.');
        }

        $attributes = ['Luas Lahan', 'Jenis Lahan', 'Jenis Bibit', 'Cuaca', 'Lama Bertani'];
        $targetAttribute = 'Jenis Pupuk';

        $calculator = new ID3Calculator($data, $attributes, $targetAttribute);
        $tree = $calculator->calculate();
        $gains = $calculator->gains;

        session([
            'generated_tree' => $tree,
            'uploaded_data' => $data,
            'gains' => $gains
        ]);

        return view('admin.rules.result', compact('tree', 'gains'));
    }

    public function confirmUpdate(Request $request)
    {
        $tree = session('generated_tree');
        $data = session('uploaded_data');

        if (!$tree || !$data) {
            return redirect()->route('admin.rules.upload')->with('error', 'Tidak ada data yang bisa disimpan.');
        }

        DB::table('rule_histories')->insert([
            'tree' => json_encode($tree),
            'data' => json_encode($data),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        session()->forget(['generated_tree', 'uploaded_data']);

        return redirect()->route('admin.rules.history')->with('success', 'Rules berhasil disimpan.');
    }

    public function saveToHistory(Request $request)
    {
        DB::table('rule_histories')->insert([
            'rules_json' => $request->tree_json,
            'gain_info' => $request->gain_info,
            'created_at' => now(),
        ]);

        return redirect()->route('admin.rules.history')->with('success', 'Hasil rules berhasil disimpan ke riwayat!');
    }

    public function saveHistory(Request $request)
    {
        DB::table('rule_histories')->insert([
            'rules_json' => json_encode($request->tree),
            'entropy_gain' => json_encode($request->gains),
            'calculation_result' => $request->calculation_result ?? '-',
            'decision_tree' => json_encode($request->tree) ?? '-',
            'created_at' => now(),
        ]);

        return redirect()->route('admin.rules.history')->with('success', 'Riwayat perhitungan berhasil disimpan.');
    }
}
