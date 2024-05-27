@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8 mt-3">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>
                <div class="card-body d-flex flex-column">
                    <img src="{{ Vite::asset('resources/assets/avatar_dummy.jpeg') }}" alt="mdo" width="25%"
                        height="25%" class="rounded-circle align-self-center">
                    <h4 class="card-title mt-4 text-center">Master Admin</h4>
                    <h5>Data Karyawan</h5>
                    <h6>Nama</h6>
                    <input class="" type="text" name="alamat" id="alamat" value="{{ $datakaryawan->alamat }}"
                        disabled>
                    <h6>Alamat</h6>
                    <input class="" type="text" name="alamat" id="alamat" value="Liant" disabled>
                    <h6>Nomor Telepon</h6>
                    <input class="" type="text" name="alamat" id="alamat" value="Liant" disabled>
                    <h6>Status Karyawan</h6>
                    <input class="" type="text" name="alamat" id="alamat" value="Liant" disabled>
                    <h6>Keahlian</h6>
                    <input class="" type="text" name="alamat" id="alamat" value="Liant" disabled>
                    <h6>Jabatan</h6>
                    <input class="" type="text" name="alamat" id="alamat" value="Liant" disabled>
                    <h5 class="mt-3">Data Akun</h5>
                    <h6>Username</h6>
                    <input class="" type="text" name="alamat" id="alamat" value="Liant" disabled>
                    <h6>Email</h6>
                    <input class="" type="text" name="alamat" id="alamat" value="Liant" disabled>
                    <h6>Password</h6>
                    <input class="" type="password" name="password" id="password" value="admin@igi" disabled>
                    <a href="#" class="btn btn-primary mt-3">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
@endsection
