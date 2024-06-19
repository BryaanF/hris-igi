@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10 mt-3">
            <div class="card">
                <div class="card-header">{{ __('Panduan penggunaan aplikasi') }}</div>
                <div class="card-body">
                    @auth
                        @if (Auth::user()->hasRole('Administrator'))
                            <h3>Bagian Admin</h3>
                            <h5>Data Karyawan</h5>
                            <p>Cara menggunakan data karyawan yaitu ...</p>
                        @endif
                    @endauth

                    <h3>Bagian Karyawan</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
