@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10 mt-3">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success text-center" role="alert">
                            <h6>Selamat Datang di Sistem Informasi Sumber Daya Manusia PT. Indo Global Impex </h6>
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1 class="text-center">Cara Penggunaan Aplikasi</h1>
                    @auth
                        @if (Auth::user()->hasRole('Administrator'))
                            <h3>Bagian Admin</h3>
                            <h5>Data Karyawan</h5>
                            <p>Cara menggunakan data karyawan yaitu</p>
                        @endif
                    @endauth

                    <h3>Bagian Karyawan</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
