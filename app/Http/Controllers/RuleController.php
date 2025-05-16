<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RuleController extends Controller
{
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
        // Akan diisi saat lanjut proses upload Excel
    }

    public function confirmUpdate(Request $request)
    {
        // Akan diisi saat admin konfirmasi ubah rules
    }
}

