@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mt-3 mb-3">
            <div class="card-header">Data Karyawan</div>
            <div class="card-body d-flex justify-content-end">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="{{ route('datakaryawan.exportExcel') }}" class="btn btn-outline-success">
                            <i class="bi bi-download me-1"></i><span>Excel</span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ route('datakaryawan.exportPDF') }}" class="btn btn-outline-danger">
                            <i class="bi bi-download me-1"></i><span>PDF</span>
                        </a>
                    </li>
                    <li class="list-inline-item">|</li>
                    <li class="list-inline-item">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createDataKaryawan">
                            <i class="bi bi-plus-circle me-1"></i><span>Tambah Data</span>
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                {{-- {{ $dataTable->table() }} --}}
                <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable"
                    id="dataKaryawanTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Status Karyawan</th>
                            <th>Keahlian</th>
                            <th>Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>

    {{-- start modal section --}}

    {{-- modal create --}}
    <div class="modal fade" id="createDataKaryawan" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('datakaryawan.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createDataKaryawanModalLabel">Tambah Karyawan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center">Data Karyawan</h4>
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama</label>
                            <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama"
                                id="nama" value="{{ old('nama') }}" placeholder="Masukkan nama karyawan">
                            @error('nama')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mt-1">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input class="form-control @error('alamat') is-invalid @enderror" type="text" name="alamat"
                                id="alamat" value="{{ old('alamat') }}" placeholder="Masukkan alamat karyawan">
                            @error('alamat')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mt-1">
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
                        <div class="form-group my-2">
                            <label for="statusKaryawan" class="form-label">Status Karyawan</label>
                            <select class="d-block" name="statusKaryawan" id="statusKaryawan">
                                <option value="Karyawan_Tetap">Karyawan Tetap</option>
                                <option value="Karyawan_Kontrak">Karyawan Kontrak</option>
                            </select>
                            @error('statusKaryawan')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mt-1">
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
                        <div class="form-group mt-1">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input class="form-control @error('jabatan') is-invalid @enderror" type="text" name="jabatan"
                                id="jabatan" value="{{ old('jabatan') }}" placeholder="Masukkan jabatan">
                            @error('jabatan')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <h4 class="text-center mt-3">Data Akun</h4>
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
                        <div class="form-group mt-1">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="text"
                                name="email" id="email" value="{{ old('email') }}" placeholder="Masukkan email">
                            @error('email')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mt-1">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password"
                                name="password" id="password" value="" placeholder="Masukkan password">
                            @error('password')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mt-1">
                            <label for="password_confirmation" class="form-label">Password Confirmation</label>
                            <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                type="password" name="password_confirmation" id="password_confirmation" value=""
                                placeholder="Masukkan password ulang">
                            @error('password_confirmation')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="role" class="form-label">Role</label>
                            <select class="d-block" name="role" id="role">
                                <option value="Administrator">Administrator</option>
                                <option value="Employee">Karyawan Reguler</option>
                            </select>
                            @error('role')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <p class="fw-bold">Note : Pastikan username karyawan yang dimasukkan merupakan username yang unik
                            dan pastikan sudah benar karena tidak dapat diganti setelah data karyawan beserta akun telah
                            berhasil dibuat.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal edit --}}
    <div class="modal fade" id="editDataKaryawan" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('datakaryawan.update', ':id') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title" id="editDataKaryawanModalLabel">Edit Data Karyawan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5 class="text-center">Data Utama</h5>
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="id" id="id" value="">
                        </div>
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
@enderror" type="text"
                                name="alamat" id="alamat" value="{{ old('alamat') }}"
                                placeholder="Masukkan alamat karyawan">
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
                        <div class="form-group my-2">
                            <label for="statusKaryawan" class="form-label">Status Karyawan</label>
                            <select class="d-block" name="statusKaryawan" id="statusKaryawan">
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
                            <input class="form-control @error('jabatan') is-invalid @enderror" type="text"
                                name="jabatan" id="jabatan" value="{{ old('jabatan') }}"
                                placeholder="Masukkan jabatan">
                            @error('jabatan')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <h5 class="text-center mt-3">Data Akun</h5>
                        <div class="form-group">
                            <label for="username" class="form-label">Username</label>
                            <input class="form-control @error('username') is-invalid @enderror" type="text"
                                name="username" id="username" value="" placeholder="Masukkan username" disabled>
                            @error('username')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mt-1">
                            <label for="email" class="form-label">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="text"
                                name="email" id="email" value="" placeholder="Masukkan email">
                            @error('email')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password"
                                name="password" id="password" value="" placeholder="Masukkan password baru">
                            @error('password')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Password Confirmation</label>
                            <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                type="password" name="password_confirmation" id="password_confirmation" value=""
                                placeholder="Masukkan ulang password baru">
                            @error('password_confirmation')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="role" class="form-label">Role</label>
                            <select class="d-block" name="role" id="role">
                                <option value="Administrator">Administrator</option>
                                <option value="Employee">Karyawan</option>
                            </select>
                            @error('role')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal detail / show --}}
    <div class="modal fade" id="showDataKaryawan" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title" id="showDataKaryawanModalLabel">Detail Data Karyawan</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama</label>
                            <input class="form-control @error('nama') is-invalid
@enderror" type="text"
                                name="nama" id="nama" disabled>
                            @error('nama')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input class="form-control @error('alamat') is-invalid
@enderror" type="text"
                                name="alamat" id="alamat" disabled>
                            @error('alamat')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nomorTelepon" class="form-label">Nomor Telepon</label>
                            <input class="form-control @error('nomorTelepon') is-invalid @enderror" type="text"
                                name="nomorTelepon" id="nomorTelepon" disabled>
                            @error('nomorTelepon')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="statusKaryawan" class="form-label">Status Karyawan</label>
                            <select name="statusKaryawan" id="statusKaryawan" disabled>
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
                                name="keahlian" id="keahlian" disabled>
                            @error('keahlian')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input class="form-control @error('jabatan') is-invalid @enderror" type="text"
                                name="jabatan" id="jabatan" disabled>
                            @error('jabatan')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                </form>
            </div>
        </div>
    </div>

    {{-- end modal section --}}
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function() {
            // show table record with datatable
            var table = $("#dataKaryawanTable").DataTable({
                serverSide: true,
                processing: true,
                ajax: "/getDataKaryawan",
                columns: [{
                        data: "id_data_karyawan",
                        name: "id_data_karyawan",
                        visible: false
                    },
                    {
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "nama",
                        name: "nama"
                    },
                    {
                        data: "status_karyawan",
                        name: "status_karyawan"
                    },
                    {
                        data: "keahlian",
                        name: "keahlian"
                    },
                    {
                        data: "jabatan",
                        name: "jabatan"
                    },
                    {
                        data: "aksi",
                        name: "aksi",
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [0, "desc"]
                ],
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"],
                ],
            });

            // Edit form with bootstrap modal with data
            $('#dataKaryawanTable').on('click', '.btn-edit', function(event) {
                event.preventDefault();
                var $tr = $(this).closest('tr');
                if ($tr.hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();

                // Populate your edit modal with data
                $('#editDataKaryawan input[name="id"]').val(data.id_data_karyawan);
                $('#editDataKaryawan input[name="nama"]').val(data.nama);
                $('#editDataKaryawan input[name="alamat"]').val(data.alamat);
                $('#editDataKaryawan input[name="nomorTelepon"]').val(data.nomor_telepon);
                $('#editDataKaryawan select[name="statusKaryawan"]').val(data.status_karyawan);
                $('#editDataKaryawan input[name="keahlian"]').val(data.keahlian);
                $('#editDataKaryawan input[name="jabatan"]').val(data.jabatan);
                $('#editDataKaryawan input[name="username"]').val(data.user.username);
                $('#editDataKaryawan input[name="email"]').val(data.user.email);
                $('#editDataKaryawan input[name="password"]').val(data.user.password);
                $('#editDataKaryawan select[name="role"]').val(data.user.role);



                var updateRoute = "{{ route('datakaryawan.update', ':id') }}";
                updateRoute.replace(':id', data.id_data_karyawan);

                // Set form action URL dynamically
                var actionUrl = '/datakaryawan/' + data.id_data_karyawan;
                $('#editDataKaryawan form').attr('action', actionUrl);

            });

            // show form with bootstrap modal
            $('#dataKaryawanTable').on('click', '.btn-show', function(event) {
                event.preventDefault();
                var $tr = $(this).closest('tr');
                if ($tr.hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();
                console.log(data); // Debug statement

                // Populate your show modal with data
                $('#showDataKaryawan input[name="nama"]').val(data.nama);
                $('#showDataKaryawan input[name="alamat"]').val(data.alamat);
                $('#showDataKaryawan input[name="nomorTelepon"]').val(data.nomor_telepon);
                $('#showDataKaryawan select[name="statusKaryawan"]').val(data.status_karyawan);
                $('#showDataKaryawan input[name="keahlian"]').val(data.keahlian);
                $('#showDataKaryawan input[name="jabatan"]').val(data.jabatan);

                // Set form action URL dynamically
                var actionUrl = '/datakaryawan/' + data.id_data_karyawan;
                $('#showDataKaryawan form').attr('action', actionUrl);
            });

            // delete confirmation with sweetalert by realrashid
            $(".datatable").on("click", ".btn-delete", function(e) {
                e.preventDefault();
                var form = $(this).closest("form");
                var nama = $(this).data("nama");

                Swal.fire({
                    title: "Apakah anda yakin ingin menghapus data \n" + nama + "?",
                    text: "Anda tidak bisa mengembalikan data setelah terhapus!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "bg-primary",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Tidak, jangan hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
