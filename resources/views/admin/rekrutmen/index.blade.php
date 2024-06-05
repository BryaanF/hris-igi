@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mt-3 mb-3">
            <div class="card-header">Data Rekrutmen</div>
            <div class="card-body d-flex justify-content-end">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="" class="btn btn-outline-success">
                            <i class="bi bi-download me-1"></i> Ekspor ke Excel
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="" class="btn btn-outline-danger">
                            <i class="bi bi-download me-1"></i>Ekspor ke PDF
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createRekrutmen">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Data Rekrutmen
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table class="table table-bordered table-hover table-striped mb-0 bg-white" id="dataRekrutmenTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Keahlian</th>
                            <th>Catatan</th>
                            <th>Status Rekrutmen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>

    {{-- start modal section --}}

    {{-- modal create --}}
    <div class="modal fade" id="createRekrutmen" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('rekrutmen.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createRekrutmenModalLabel">Tambah Karyawan</h5>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center">Data Rekrutmen</h4>
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
                            <label for="catatan" class="form-label">Catatan</label>
                            <input class="form-control @error('catatan') is-invalid @enderror" type="text" name="catatan"
                                id="catatan" value="{{ old('catatan') }}" placeholder="Masukkan catatan">
                            @error('catatan')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            aria-label="close">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Penambahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal edit --}}
    <div class="modal fade" id="editRekrutmen" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('rekrutmen.update', ':id') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title" id="editRekrutmenModalLabel">Edit Data Karyawan</h4>
                    </div>
                    <div class="modal-body">
                        <h5 class="text-center">Data Utama</h5>
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="id" id="id" value="">
                        </div>
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
                        <div class="form-group">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input class="form-control @error('alamat') is-invalid @enderror" type="text"
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
                        <div class="form-group mt-1">
                            <label for="catatan" class="form-label">Catatan</label>
                            <input class="form-control @error('catatan') is-invalid @enderror" type="text"
                                name="catatan" id="catatan" value="{{ old('catatan') }}"
                                placeholder="Masukkan catatan">
                            @error('catatan')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="statusRekrutmen" class="form-label">Status Rekrutmen</label>
                            <select class="d-block" name="statusRekrutmen" id="statusRekrutmen" disabled>
                                <option value="Diterima">Diterima</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                            @error('statusRekrutmen')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal detail / show --}}
    <div class="modal fade" id="showRekrutmen" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h4 class="modal-title" id="showRekrutmenModalLabel">Detail Data Karyawan</h4>
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
                        <div class="form-group mt-1">
                            <label for="catatan" class="form-label">Catatan</label>
                            <input class="form-control @error('catatan') is-invalid @enderror" type="text"
                                name="catatan" id="catatan" value="{{ old('catatan') }}"
                                placeholder="Masukkan catatan">
                            @error('catatan')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group my-2">
                            <label for="statusRekrutmen" class="form-label">Status Rekrutmen</label>
                            <select class="d-block" name="statusRekrutmen" id="statusRekrutmen">
                                <option value="Diterima">Diterima</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                            @error('statusRekrutmen')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    {{-- end modal section --}}
@endsection
@push('scripts')
    {{-- {{ $dataTable->scripts() }} --}}
    <script type="module">
        $(document).ready(function() {
            $("#dataRekrutmenTable").DataTable({
                serverSide: true,
                processing: true,
                ajax: "/getRekrutmen",
                columns: [{
                        data: "id_rekrutmen",
                        name: "id_rekrutmen",
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
                        data: "keahlian",
                        name: "keahlian"
                    },
                    {
                        data: "catatan",
                        name: "catatan"
                    },
                    {
                        data: "status_rekrutmen",
                        name: "status_rekrutmen"
                    },
                    {
                        data: "actions",
                        name: "actions",
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
            $('#dataRekrutmenTable').on('click', '.btn-edit', function(event) {
                event.preventDefault();
                var $tr = $(this).closest('tr');
                if ($tr.hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();
                console.log(data); // Debug statement

                // Populate your edit modal with data
                $('#editRekrutmen input[name="id"]').val(data.id_data_karyawan);
                $('#editRekrutmen input[name="nama"]').val(data.nama);
                $('#editRekrutmen input[name="alamat"]').val(data.alamat);
                $('#editRekrutmen input[name="nomorTelepon"]').val(data.nomor_telepon);
                $('#editRekrutmen select[name="statusKaryawan"]').val(data.status_karyawan);
                $('#editRekrutmen input[name="keahlian"]').val(data.keahlian);
                $('#editRekrutmen input[name="jabatan"]').val(data.jabatan);
                $('#editRekrutmen input[name="username"]').val(data.user.username);
                $('#editRekrutmen input[name="email"]').val(data.user.email);
                $('#editRekrutmen input[name="password"]').val(data.user.password);
                $('#editRekrutmen select[name="role"]').val(data.user.role);



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
                $('#showRekrutmen input[name="nama"]').val(data.nama);
                $('#showRekrutmen input[name="alamat"]').val(data.alamat);
                $('#showRekrutmen input[name="nomorTelepon"]').val(data.nomor_telepon);
                $('#showRekrutmen select[name="statusKaryawan"]').val(data.status_karyawan);
                $('#showRekrutmen input[name="keahlian"]').val(data.keahlian);
                $('#showRekrutmen input[name="jabatan"]').val(data.jabatan);

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
                    title: "Yakin ingin menghapus \n" + name + "?",
                    text: "Anda tidak bisa mengembalikan data yang telah terhapus!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "bg-primary",
                    confirmButtonText: "Ya, hapus data!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
