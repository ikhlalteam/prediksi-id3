<?php

namespace App\Http\Controllers;

use App\Exports\PrediksiExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export()
    {
        return Excel::download(new PrediksiExport, 'hasil-prediksi.xlsx');
    }

    
}
