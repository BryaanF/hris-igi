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

    public function panduan()
    {
        return view('guide');
    }
}
