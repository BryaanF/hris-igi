<?php

namespace App\Http\Controllers;

use Alert;
use App\Exports\DataRekrutmenExport;
use App\Models\Rekrutmen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Validator;

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
        $datarekrutmen = Rekrutmen::all();

        confirmDelete();

        return view('admin.rekrutmen.index', compact('datarekrutmen'));
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
            'keahlian' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ELOQUENT DATA REKRUTMEN
        $datarekrutmen = new Rekrutmen;
        $datarekrutmen->nama = $request->nama;
        $datarekrutmen->alamat = $request->alamat;
        $datarekrutmen->nomor_telepon = $request->nomorTelepon;
        $datarekrutmen->status_rekrutmen = 'Proses';
        $datarekrutmen->keahlian = $request->keahlian;
        $datarekrutmen->catatan = $request->catatan;
        $datarekrutmen->save();

        Alert::success('Berhasil ditambahkan', 'Data rekrutmen berhasil ditambahkan!');

        return redirect()->route('rekrutmen.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $datarekrutmen = Rekrutmen::find($id);

        return view('admin.rekrutmen.index', compact('datarekrutmen'));
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
            'keahlian' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Inisiasi pemanggilan data dari database ke variabel
        $datarekrutmen = Rekrutmen::find($id);

        dd($datarekrutmen);

        // ELOQUENT DATA REKRUTMEN
        $datarekrutmen->nama = $request->nama;
        $datarekrutmen->alamat = $request->alamat;
        $datarekrutmen->nomor_telepon = $request->nomorTelepon;
        $datarekrutmen->keahlian = $request->keahlian;
        $datarekrutmen->catatan = $request->catatan;
        $datarekrutmen->save();

        Alert::success('Berhasil Disunting', 'Data rekrutmen berhasil disunting!');

        return redirect()->route('rekrutmen.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // ELOQUENT
        Rekrutmen::find($id)->delete();

        Alert::success('Data Berhasil Dihapus', 'Data rekrutmen berhasil dihapus!');

        return redirect()->route('rekrutmen.index');

    }

    public function getData(Request $request)
    {
        $datarekrutmen = Rekrutmen::query();
        if ($request->ajax()) {
            return datatables()->of($datarekrutmen)
                ->addIndexColumn()
                ->addColumn('actions', function ($satudatarekrutmen) {
                    return view('admin.rekrutmen.actions', compact('satudatarekrutmen'));
                })
                ->toJson();
        }
    }

    public function statusRekrutmenQuery(Request $request, String $id)
    {
        // Inisiasi pemanggilan data dari database ke variabel
        $datarekrutmen = Rekrutmen::find($id);

        // request->button_value merupakan input hidden yang ada pada form input yang menyimpan data value dari tombol diterima, ditolak, dan proses
        $button_value = $request->button_value;

        // Eloquent kolom status_rekrutmen
        $datarekrutmen->status_rekrutmen = $button_value;
        $datarekrutmen->save();

        if ($button_value == 'Diterima') {
            Alert::success('Kandidat telah diterima', 'Kandidat telah resmi menjadi karyawan!');

        } else if ($button_value == 'Ditolak') {
            Alert::error('Kandidat telah ditolak', 'Kandidat berhasil ditolak, gagal menjadi karyawan!');
        } else {
            Alert::info('Kandidat dalam tahap proses', 'Kandidat masih dalam tahap proses perekrutan lebih lanjut!');
        }

        return redirect()->route('rekrutmen.index');
    }

    public function exportExcel()
    {
        return Excel::download(new DataRekrutmenExport, 'Data Rekrutmen.xlsx');
    }

    public function exportPDF()
    {
        $datarekrutmen = Rekrutmen::all();
        $pdf = PDF::loadView('admin.rekrutmen.export_pdf', compact('datarekrutmen'));
        return $pdf->download('Data Rekrutmen.pdf');
    }
}
