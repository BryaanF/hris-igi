@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            {{-- petunjuk di page mana --}}
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are in daftar absensi!') }}
                </div>
            </div>

        </div>
        <div class="col-md-10">
            {{-- isi --}}
            <div class="card mt-3">
                <div class="card-header">{{ __('Design Plan') }}</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama</th>

                                <th>Keterangan</th>
                                <th>Status Absensi</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>1 Januari 2024</td>
                                <td>Brilliant Fikri</td>

                                <td>-</td>
                                <td>Hadir</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>1 Januari 2024</td>
                                <td>Johan Calvin</td>

                                <td>-</td>
                                <td>Alpha</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>1 Januari 2024</td>
                                <td>Rama Prihandana</td>

                                <td>Membayar pajak STNK</td>
                                <td>Izin</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
