<?php

namespace App\Http\Controllers;

use App\Exports\DataKaryawanExport;
use App\Models\DataKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;

class AdminControllerOne extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // use UsersDataTable $dataTable inside parameter index to use datatable html builder
    public function index()
    {
        // return $dataTable->render('admin.datakaryawan');
        $datakaryawan = DataKaryawan::with(['rekrutmen', 'user']);
        confirmDelete();
        return view('admin.datakaryawan.index', compact('datakaryawan'));
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
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka',
        ];
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'nomorTelepon' => 'required|numeric',
            'statusKaryawan' => 'required',
            'keahlian' => 'required',
            'jabatan' => 'required',
            // 'email' => 'required|email',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ELOQUENT
        $datakaryawan = new DataKaryawan;
        $datakaryawan->nama = $request->nama;
        $datakaryawan->alamat = $request->alamat;
        $datakaryawan->nomor_telepon = $request->nomorTelepon;
        $datakaryawan->status_karyawan = $request->statusKaryawan;
        $datakaryawan->keahlian = $request->keahlian;
        $datakaryawan->jabatan = $request->jabatan;
        $datakaryawan->user_id = 2;
        $datakaryawan->rekrutmen_id = 2;

        $datakaryawan->save();

        Alert::success('Added Successfully', 'Data karyawan berhasil ditambahkan!');

        return redirect()->route('datakaryawan.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // ELOQUENT
        $datakaryawan = DataKaryawan::with(['rekrutmen', 'user'])->find($id);
        return view('admin.datakaryawan.detail', compact('datakaryawan'));
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
        // ELOQUENT
        DataKaryawan::find($id)->delete();

        Alert::success('Data Berhasil Dihapus', 'Data Karyawan telah berhasil dihapus!');

        return redirect()->route('datakaryawan.index');

    }

    public function getData(Request $request)
    {
        $datakaryawan = DataKaryawan::with(['rekrutmen', 'user']);
        // if ($request->ajax()) {
        return datatables()->of($datakaryawan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($satudatakaryawan) {
                return view('admin.datakaryawan.actions', compact('satudatakaryawan'));
            })
            ->toJson();
        // }
    }

    public function exportExcel()
    {
        return Excel::download(new DataKaryawanExport, 'Data Karyawan.xlsx');
    }

    public function exportPdf()
    {
        $datakaryawan = DataKaryawan::all();
        $pdf = PDF::loadView('admin.datakaryawan.export_pdf', compact('datakaryawan'));
        return $pdf->download('Data Karyawan.pdf');
    }
}
