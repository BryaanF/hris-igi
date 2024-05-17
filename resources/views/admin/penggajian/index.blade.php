@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are in penggajian!') }}
                    <button class="btn btn-outline-dark btn-sm me-2 btn-create" data-bs-toggle="modal"
                        data-bs-target="#editDataKaryawan"><i class="bi-person-lines-fill"></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="editDataKaryawan" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="dataKaryawanModalLabel">Edit
                            Karyawan</h5>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center">Data Karyawan</h4>
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama</label>
                            <input class="form-control @error('nama') is-invalid
@enderror" type="text" name="nama"
                                id="nama" value="{{ old('nama') }}" placeholder="Masukkan nama karyawan">
                            @error('nama')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input class="form-control @error('alamat') is-invalid
@enderror" type="text" name="alamat"
                                id="alamat" value="{{ old('alamat') }}" placeholder="Masukkan alamat karyawan">
                            @error('alamat')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nomorTelepon" class="form-label">Nomor Telepon</label>
                            <input class="form-control @error('nomorTelepon') is-invalid @enderror" type="text"
                                name="nomorTelepon" id="nomorTelepon" value="{{ old('nomorTelepon') }}"
                                placeholder="Masukkan nomor telepon karyawan">
                            @error('nomorTelepon')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="statusKaryawan" class="form-label">Status Karyawan</label>
                            <select name="statusKaryawan" id="statusKaryawan">
                                <option value="Karyawan_Tetap">Karyawan Tetap</option>
                                <option value="Karyawan_Kontrak">Karyawan Kontrak</option>
                            </select>
                            @error('statusKaryawan')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keahlian" class="form-label">Keahlian</label>
                            <input class="form-control @error('keahlian') is-invalid @enderror" type="text"
                                name="keahlian" id="keahlian" value="{{ old('keahlian') }}"
                                placeholder="Masukkan keahlian yang dimiliki karyawan">
                            @error('keahlian')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input class="form-control @error('jabatan') is-invalid @enderror" type="text" name="jabatan"
                                id="jabatan" value="{{ old('jabatan') }}" placeholder="Masukkan jabatan">
                            @error('jabatan')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>

                        <h4 class="text-center">Data Akun</h4>

                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <input class="form-control @error('username') is-invalid @enderror" type="text"
                                name="username" id="username" value="{{ old('username') }}"
                                placeholder="Masukkan username">
                            @error('username')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">password</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="text"
                                name="password" id="password" value="{{ old('password') }}"
                                placeholder="Masukkan password">
                            @error('password')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role">
                                <option value="Administrator">Administrator</option>
                                <option value="Karyawan_Reguler">Karyawan Reguler</option>
                            </select>
                            @error('role')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script></script>
@endpush
