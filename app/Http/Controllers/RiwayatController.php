<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Prediksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RuleHistory;
use App\Models\Id3Rule;
use Illuminate\Support\Facades\Session;



class RiwayatController extends Controller
{
    public function index()
    {
        $riwayat = Prediksi::where('user_id', Auth::id())
                    ->latest()
                    ->get();

        return view('riwayat', compact('riwayat'));
    }


    public function history()
    {
        $riwayat = DB::table('rule_histories')->latest()->get();
        return view('admin.rules.history', compact('riwayat'));
    }

    public function uploadForm()
    {
        return view('admin.rules.upload');
    }

    public function upload(Request $request)
    {
        // untuk proses upload excel (akan diisi nanti)
    }

    public function confirmUpdate(Request $request)
    {
        // untuk update rules (akan diisi nanti)
    }

    
public function previewRule(Request $request)
{
    $history = RuleHistory::findOrFail($request->id);
    Session::put('preview_rule_id', $history->id);
    return view('admin.rules.preview', compact('history'));
}

public function confirmRule()
{
    $historyId = Session::get('preview_rule_id');
    $history = RuleHistory::findOrFail($historyId);
    
    Id3Rule::truncate(); // kosongkan rule lama
    Id3Rule::create([
        'rule' => $history->rules_json
    ]);

    Session::forget('preview_rule_id');
    return redirect()->route('admin.dashboard')->with('success', 'Rules berhasil diperbarui!');
}

public function cancelRule()
{
    Session::forget('preview_rule_id');
    return redirect()->route('admin.dashboard')->with('info', 'Penggantian rules dibatalkan.');
}

public function deleteHistory($id)
{
    RuleHistory::destroy($id);
    return redirect()->back()->with('success', 'Riwayat berhasil dihapus.');
}

}


