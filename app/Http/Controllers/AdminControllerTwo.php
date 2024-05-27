<?php

namespace App\Http\Controllers;

use App\Models\Rekrutmen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


// controller for rekrutmen
class AdminControllerTwo extends Controller
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
        return view('admin.rekrutmen.index');
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

    public function getData(Request $request)
    {
        $datarekrutmen = Rekrutmen::query();
        if ($request->ajax()) {
            return datatables()->of($datarekrutmen)
                ->addIndexColumn()
                ->addColumn('actions', function ($datarekrutmen) {
                    return view('admin.rekrutmen.actions', compact('datarekrutmen'));
                })
                ->toJson();
        }
    }
}
