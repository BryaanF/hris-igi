<?php

namespace App\Http\Controllers;

use App\Models\DataKaryawan;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
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
    public function index()
    {
        // Mengambil pengguna yang sedang login

        $user = Auth::user();

        // Mengambil data karyawan yang terkait
        $datakaryawan = $user->datakaryawan;

        dd($user);

        return view('profile.index', compact('user', 'datakaryawan'));
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
        //
    }
}
