<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\DataKaryawan;
use Illuminate\Http\Request;

class AdminControllerOne extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('admin.datakaryawan');

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
        dd(base_path('vendor') . '/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf');
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
        $datakaryawan = DataKaryawan::with(['rekrutmen', 'user'])->get();
        if ($request->ajax()) {
            $formattedData = $datakaryawan->map(function ($item) {
                return [
                    'id_data_karyawan' => $item->id_data_karyawan,
                    'nama' => $item->nama,
                    'alamat' => $item->alamat,
                    'nomor_telepon' => $item->nomor_telepon,
                    'status_karyawan' => $item->status_karyawan,
                    'keahlian' => $item->keahlian,
                    'jabatan' => $item->jabatan,
                    'actions' => view('admin.actions', compact('item'))->render(),
                ];
            });

            return response()->json($formattedData);
        }

    }
}
