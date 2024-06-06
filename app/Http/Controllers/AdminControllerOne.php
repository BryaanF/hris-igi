<?php

namespace App\Http\Controllers;

use Alert;
use App\Exports\DataKaryawanExport;
use App\Models\DataKaryawan;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Validator;

// controller for datakaryawan

class AdminControllerOne extends Controller
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
    // use UsersDataTable $dataTable inside parameter index to use datatable html builder
    public function index()
    {
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
            'email' => 'required|email',
            'username' => 'required|unique:users,username', // Validasi untuk username
            'password' => 'required|min:6|confirmed', // Validasi untuk password
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ELOQUENT DATA AKUN
        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        // ELOQUENT DATA KARYAWAN
        $datakaryawan = new DataKaryawan;
        $datakaryawan->nama = $request->nama;
        $datakaryawan->alamat = $request->alamat;
        $datakaryawan->nomor_telepon = $request->nomorTelepon;
        $datakaryawan->status_karyawan = $request->statusKaryawan;
        $datakaryawan->keahlian = $request->keahlian;
        $datakaryawan->jabatan = $request->jabatan;
        $datakaryawan->user_id = $user->id_user;
        $datakaryawan->rekrutmen_id = $rekrutmen->id_rekrutmen;
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
        return view('admin.datakaryawan.index', compact('datakaryawan'));
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
            'email' => 'required|email',
            'password' => 'min:6|confirmed',
            'role' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Inisiasi pemanggilan data dari database ke variabel
        $datakaryawan = DataKaryawan::find($id);
        $user = User::find($datakaryawan->user_id);

        // ELOQUENT DATA AKUN
        $user->email = $request->email;
        if ($request->password !== null) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->save();

        // ELOQUENT DATA KARYAWAN
        $datakaryawan->nama = $request->nama;
        $datakaryawan->alamat = $request->alamat;
        $datakaryawan->nomor_telepon = $request->nomorTelepon;
        $datakaryawan->status_karyawan = $request->statusKaryawan;
        $datakaryawan->keahlian = $request->keahlian;
        $datakaryawan->jabatan = $request->jabatan;
        $datakaryawan->save();

        Alert::success('Berhasil Disunting', 'Data karyawan berhasil disunting!');

        return redirect()->route('datakaryawan.index');

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

        if ($request->ajax()) {
            return datatables()->of($datakaryawan)
                ->addIndexColumn()
                ->addColumn('aksi', function ($satudatakaryawan) {
                    return view('admin.datakaryawan.actions', compact('satudatakaryawan'));
                })
                ->toJson();
        }
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
