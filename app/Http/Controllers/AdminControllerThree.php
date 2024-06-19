<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\Absensi;
use App\Models\DataKaryawan;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

// controller for daftarabsensi
class AdminControllerThree extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        confirmDelete(); // untuk konfirmasi delete dan juga trigger sweetalert di index
        return view('admin.daftarabsensi.index');
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
        $daftarabsensi = Absensi::find($id);

        $daftarabsensi->delete();

        Alert::success('Data Absensi Dihapus', 'Data absensi karyawan telah berhasil dihapus!');

        return redirect()->route('daftarabsensi.index');

    }

    public function getData(Request $request)
    {
        $datadaftarabsensi = Absensi::with('dataKaryawan')->select('absensi.*', 'data_karyawan.nama as nama_karyawan')
            ->join('data_karyawan', 'absensi.data_karyawan_id', '=', 'data_karyawan.id_data_karyawan');
        if ($request->ajax()) {
            return datatables()->of($datadaftarabsensi)
                ->addIndexColumn()
                ->addColumn('actions', function ($satudatadaftarabsensi) {
                    return view('admin.daftarabsensi.actions', compact('satudatadaftarabsensi'));
                })
                ->toJson();
        }
    }

    public function generateAbsenceData(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'date' => 'Masukkan data dalam bentuk tanggal yang benar',
        ];
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error_in_modal', 1);
        }

        $datakaryawan = DataKaryawan::all();
        $tanggal = $request->input('tanggal');

        foreach ($datakaryawan as $dk) {
            // Periksa apakah entri absensi dengan tanggal dan data karyawan yang sama sudah ada
            $existingAbsensi = Absensi::where('tanggal', $tanggal)
                ->where('data_karyawan_id', $dk->id_data_karyawan)
                ->exists();

            if (!$existingAbsensi) {
                // ELOQUENT DATA KARYAWAN
                $daftarabsensi = new Absensi;
                $daftarabsensi->tanggal = $tanggal;
                $daftarabsensi->jam_masuk = '00:00:00';
                $daftarabsensi->status_absensi = 'Alpha';
                $daftarabsensi->keterangan = '';
                $daftarabsensi->data_karyawan_id = $dk->id_data_karyawan;
                $daftarabsensi->save();
            }
        }

        Alert::success('Berhasil Generate Daftar Absensi Karyawan', 'Berhasil generate data absen karyawan untuk tanggal yang telah ditentukan!');
        return redirect()->route('daftarabsensi.index');
    }

    public function showLoginAbsensiForm()
    {
        return view('admin.daftarabsensi.loginabsensi');
    }

    public function authenticationAbsensiForm(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
        ];
        $validator = Validator::make($request->all(), [
            'password' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->password === env('MASTER_PASSWORD')) {
            $request->session()->put('master_authenticated', true);
            return redirect()->route('daftarabsensi.absensi');
        } else {
            return redirect()->back()->withErrors(['password' => 'Master password is incorrect']);
        }

    }

    public function absensi()
    {
        Auth::logout();

        return view('admin.daftarabsensi.absensi');
    }

    public function catatAbsensi(Request $request)
    {
        // validate input data (accept either email or username)
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required'],
        ]);

        // determine whether login input is email or username
        $filterUserOrEmail = filter_var($credentials['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // prepare credentials for authentication
        $authCredentials = [
            $filterUserOrEmail => $credentials['login'],
            'password' => $credentials['password'],
        ];

        if (Auth::attempt($authCredentials)) {
            $datakaryawan = DataKaryawan::whereHas('user', function ($query) use ($filterUserOrEmail, $authCredentials) {
                $query->where($filterUserOrEmail, $authCredentials[$filterUserOrEmail]);
            })->first();

            // setting carbon agar timezone sesuai timezone WIB
            $today = Carbon::today()->setTimezone('Asia/Jakarta');
            $now = Carbon::now()->setTimezone('Asia/Jakarta');

            // Cari Absensi untuk data karyawan dan tanggal hari ini
            $absensi = Absensi::where('data_karyawan_id', $datakaryawan->id_data_karyawan)
                ->whereDate('tanggal', $today)
                ->first();

            if ($absensi) {
                // Jika sudah ada entri untuk hari ini, update kolom jam_masuk dengan waktu saat ini
                $absensi->jam_masuk = $now;
                $absensi->status_absensi = 'Masuk';
                $absensi->save();
            } else {
                // Jika belum ada entri untuk hari ini, buat entri baru
                $absensi = new Absensi();
                $absensi->data_karyawan_id = $datakaryawan->id_data_karyawan;
                $absensi->tanggal = $today;
                $absensi->jam_masuk = $now;
                $absensi->status_absensi = 'Masuk';
                $absensi->save();
            }

            Alert::success('Berhasil absen', 'Anda berhasil absen untuk hari ini, cek absensi anda pada dashboard!');
            return redirect()->route('daftarabsensi.absensi');
        }

        return redirect()->back()->withErrors(['login' => 'Data login yang masukkan tidak valid, cek email / username dan password yang anda masukkan.']);

    }

    public function logoutAbsensi(Request $request)
    {
        $request->session()->forget('master_authenticated');
        return redirect()->route('login');
    }
}
