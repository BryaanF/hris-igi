<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExperimentController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        dd(session()->all());
    }
}
