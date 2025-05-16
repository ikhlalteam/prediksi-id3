<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Prediksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
}


