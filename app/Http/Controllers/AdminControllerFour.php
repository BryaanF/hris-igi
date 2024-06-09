<?php

namespace App\Http\Controllers;

use Alert;
use App\Exports\DataPersetujuanCutiExport;
use App\Models\Cuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

// controller for persetujuan cuti
class AdminControllerFour extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || !Auth::user()->hasRole('Administrator')) {
                abort(403);
            }

            return $next($request);
        });

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.persetujuancuti.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getData(Request $request)
    {
        $datapersetujuancuti = Cuti::with('dataKaryawan');
        // if ($request->ajax()) {
        return datatables()->of($datapersetujuancuti)
            ->addIndexColumn()
            ->addColumn('actions', function ($satudatapersetujuancuti) {
                return view('admin.persetujuancuti.actions', compact('satudatapersetujuancuti'));
            })
            ->toJson();
        // }
    }

    public function statusCutiQuery(Request $request, String $id)
    {
        // Inisiasi pemanggilan data dari database ke variabel
        $datapersetujuancuti = Cuti::find($id);

        // request->button_value merupakan input hidden yang ada pada form input yang menyimpan data value dari tombol diterima, ditolak, dan proses
        $button_value = $request->button_value;

        // Eloquent kolom status_rekrutmen
        $datapersetujuancuti->status_cuti = $button_value;
        $datapersetujuancuti->save();

        if ($button_value == 'Disetujui') {
            Alert::success('Pengajuan cuti disetujui', 'Pengajuan cuti karyawan diterima!');

        } else if ($button_value == 'Ditolak') {
            Alert::error('Pengajuan cuti ditolak', 'Pengajuan cuti karyawan ditolak!');
        } else {
            Alert::info('Pengajuan cuti pending', 'Permohonan pengajuan cuti karyawan masih ditinjau!');
        }

        return redirect()->route('persetujuancuti.index');
    }

    public function exportExcel()
    {
        return Excel::download(new DataPersetujuanCutiExport, 'Data Cuti.xlsx');
    }

    public function exportPDF()
    {
        $datapersetujuancuti = Cuti::with('dataKaryawan')->get();
        $pdf = PDF::loadView('admin.persetujuancuti.export_pdf', compact('datapersetujuancuti'));
        return $pdf->download('Data Cuti.pdf');
    }
}
