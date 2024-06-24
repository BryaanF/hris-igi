<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Cuti;
use App\Models\DataKaryawan;
use Auth;
use Illuminate\Http\Request;
use Validator;

// kontroller pengajuan cuti
class EmployeeControllerOne extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        confirmDelete();

        return view('employee.pengajuancuti.index');
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
            'required' => ':attribute harus diisi.',
            'numeric' => 'Isi :attribute dengan angka',
            'date' => 'Isi :attribute dengan format tanggal yang benar',
            'after' => 'Harap pilih tanggal setelah tanggal mulai cuti',
            'after_or_equal' => 'Harap pilih tanggal untuk hari ini atau setelahnya',
        ];
        $validator = Validator::make($request->all(), [
            'mulaiCuti' => 'required|date|after_or_equal:today',
            'selesaiCuti' => 'required|date|after:mulaiCuti',
            'keterangan' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Mendapatkan ID pengguna yang sedang login dari session
        $userId = Auth::id();

        $dataKaryawanId = DataKaryawan::where('user_id', $userId)->pluck('id_data_karyawan')->first();

        // ELOQUENT DATA PENGAJUAN CUTI
        $datapengajuancuti = new Cuti;
        $datapengajuancuti->mulai_cuti = $request->mulaiCuti;
        $datapengajuancuti->selesai_cuti = $request->selesaiCuti;
        $datapengajuancuti->keterangan = $request->keterangan;
        $datapengajuancuti->status_cuti = 'Pending';
        $datapengajuancuti->data_karyawan_id = $dataKaryawanId;
        $datapengajuancuti->save();

        Alert::success('Berhasil diajukan', 'Data cuti berhasil diajukan!');

        return redirect()->route('pengajuancuti.index');

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
        // Mendapatkan ID pengguna yang sedang login dari session
        $userId = Auth::id();

        $dataKaryawanId = DataKaryawan::where('user_id', $userId)->pluck('id_data_karyawan')->first();

        // Mencari data persetujuan cuti berdasarkan ID pengguna
        $datapengajuancuti = Cuti::where('data_karyawan_id', $dataKaryawanId);

        if ($request->ajax()) {
            // Jika data kosong, pastikan mengembalikan format JSON yang benar
            if ($datapengajuancuti->count() <= 0) {
                return response()->json([
                    'draw' => intval($request->input('draw')),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => [],
                ]);
            }

            return datatables()->of($datapengajuancuti)
                ->addIndexColumn()
                ->addColumn('actions', function () {
                    return view('employee.pengajuancuti.actions');
                })
                ->toJson();
        }

    }
}
