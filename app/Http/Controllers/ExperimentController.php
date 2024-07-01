<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use Illuminate\Http\Request;

class ExperimentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $id = 3;
        $gaji = Gaji::with('dataKaryawan')->find($id);
        return view('employee.riwayatgaji.export_pdf', compact('gaji'));
    }
}
