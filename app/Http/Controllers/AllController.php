<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Carbon\Carbon;

class AllController extends Controller
{
    public function dashboard()
    {
        // Mengatur lokal Carbon ke bahasa Indonesia
        Carbon::setLocale('id');

        // Mendapatkan tanggal hari ini menggunakan Carbon
        $hariini = Carbon::today()->toDateString();

        $tanggalsaatini = Carbon::today()->translatedFormat('d F Y');

        // Query dengan kondisi tanggal hari ini
        $absensi = Absensi::with('dataKaryawan')
            ->select('absensi.*', 'data_karyawan.nama as nama_karyawan')
            ->join('data_karyawan', 'absensi.data_karyawan_id', '=', 'data_karyawan.id_data_karyawan')
            ->whereDate('absensi.tanggal', $hariini)
            ->get();

        return view('index', compact('absensi', 'tanggalsaatini'));
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
