<?php

namespace App\Http\Controllers;

class AllController extends Controller
{
    public function clearSessionModal()
    {
        session()->forget('error_in_modal'); // Ganti 'error_in_modal' dengan nama session yang ingin Anda hapus
    }
}
