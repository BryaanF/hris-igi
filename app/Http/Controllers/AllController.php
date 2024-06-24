<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AllController extends Controller
{
    public function dashboard()
    {
        // Mengatur lokal Carbon ke bahasa Indonesia
        Carbon::setLocale('id');

        $tanggalsaatini = Carbon::today()->translatedFormat('d F Y');

        return view('index', compact('tanggalsaatini'));
    }

    public function getAbsensiHariIni(Request $request)
    {
        // Mengatur lokal Carbon ke bahasa Indonesia
        Carbon::setLocale('id');

        // Mendapatkan tanggal hari ini menggunakan Carbon
        $hariini = Carbon::today()->toDateString();

        // Query dengan kondisi tanggal hari ini
        $absensi = Absensi::with('dataKaryawan')
            ->select('absensi.*', 'data_karyawan.nama as nama_karyawan')
            ->join('data_karyawan', 'absensi.data_karyawan_id', '=', 'data_karyawan.id_data_karyawan')
            ->whereDate('absensi.tanggal', $hariini);

        if ($request->ajax()) {
            // Jika data kosong, pastikan mengembalikan format JSON yang benar
            if ($absensi->count() <= 0) {
                return response()->json([
                    'draw' => intval($request->input('draw')),
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => [],
                ]);
            }

            return datatables()->of($absensi)
                ->addIndexColumn()
                ->toJson();
        }

    }

    public function clearSessionModal()
    {
        session()->forget('error_in_modal'); // Ganti 'error_in_modal' dengan nama session yang ingin Anda hapus
    }

    public function panduan()
    {
        return view('guide');
    }
}
