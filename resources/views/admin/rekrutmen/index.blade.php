@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mt-3 mb-3">
            <div class="card-header">Data Rekrutmen</div>
            <div class="card-body d-flex justify-content-end">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="{{ route('rekrutmen.exportExcel') }}" class="btn btn-outline-success">
                            <i class="bi bi-download me-1"></i><span>Excel</span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ route('rekrutmen.exportPDF') }}" class="btn btn-outline-danger">
                            <i class="bi bi-download me-1"></i><span>PDF</span>
                        </a>
                    </li>
                    <li class="list-inline-item"> | </li>
                    <li class="list-inline-item">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createRekrutmen">
                            <i class="bi bi-plus-circle me-1"></i><span>Tambah Data</span>
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable"
                    id="dataRekrutmenTable">
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
                        <h5 class="modal-title" id="createRekrutmenModalLabel">Tambah Data Kandidat</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama</label>
                            <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama"
                                id="nama" value="{{ old('nama') }}" placeholder="Masukkan nama kandidat karyawan">
                            @error('nama')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mt-1">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input class="form-control @error('alamat') is-invalid @enderror" type="text" name="alamat"
                                id="alamat" value="{{ old('alamat') }}" placeholder="Masukkan alamat kandidat karyawan">
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
                                placeholder="Masukkan nomor telepon kandidat karyawan">
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
                                placeholder="Masukkan keahlian yang dimiliki kandidat karyawan">
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
                        <h4 class="modal-title" id="editRekrutmenModalLabel">Edit Data Kandidat</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="id" id="id" value="">
                        </div>
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama</label>
                            <input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama"
                                id="nama" value="{{ old('nama') }}"
                                placeholder="Masukkan nama kandidat karyawan">
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
                                placeholder="Masukkan alamat kandidat karyawan">
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
                                placeholder="Masukkan nomor telepon kandidat karyawan">
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
                                placeholder="Masukkan keahlian yang dimiliki kandidat karyawan">
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
                            <input class="form-control @error('statusRekrutmen') is-invalid @enderror" type="text"
                                name="statusRekrutmen" id="statusRekrutmen" disabled>
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
                <form action="{{ route('rekrutmen.statusRekrutmenQuery', ':id') }}" method="POST"
                    enctype="multipart/form-data" id="statusRekrutmenQueryForm">
                    @csrf

                    <div class="modal-header">
                        <h4 class="modal-title" id="showRekrutmenModalLabel">Status Penerimaan Kandidat Karyawan</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="id" id="id" value="">
                        </div>
                        <div class="form-group">
                            <label for="nama" class="form-label">Nama</label>
                            <input class="form-control @error('nama') is-invalid
@enderror" type="text"
                                name="nama" id="nama" disabled>

                        </div>
                        <div class="form-group">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input class="form-control @error('alamat') is-invalid
@enderror" type="text"
                                name="alamat" id="alamat" disabled>

                        </div>
                        <div class="form-group">
                            <label for="nomorTelepon" class="form-label">Nomor Telepon</label>
                            <input class="form-control @error('nomorTelepon') is-invalid @enderror" type="text"
                                name="nomorTelepon" id="nomorTelepon" disabled>

                        </div>
                        <div class="form-group">
                            <label for="keahlian" class="form-label">Keahlian</label>
                            <input class="form-control @error('keahlian') is-invalid @enderror" type="text"
                                name="keahlian" id="keahlian" disabled>

                        </div>
                        <div class="form-group mt-1">
                            <label for="catatan" class="form-label">Catatan</label>
                            <input class="form-control @error('catatan') is-invalid @enderror" type="text"
                                name="catatan" id="catatan" disabled>

                        </div>
                        <div class="form-group my-2">
                            <label for="statusRekrutmen" class="form-label">Status Rekrutmen</label>
                            <input class="form-control @error('statusRekrutmen') is-invalid @enderror" type="text"
                                name="statusRekrutmen" id="statusRekrutmen" disabled>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="button_value" id="button_value">
                            <button type="button" class="btn btnquery btn-success" value="Diterima">Terima</button>
                            <button type="button" class="btn btnquery btn-primary" value="Proses">Proses</button>
                            <button type="button" class="btn btnquery btn-danger" value="Ditolak">Tolak</button>
                            <span class="mx-2"> | </span>
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
            var table = $("#dataRekrutmenTable").DataTable({
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

                // Populate your edit modal with data
                $('#editRekrutmen input[name="id"]').val(data.id_rekrutmen);
                $('#editRekrutmen input[name="nama"]').val(data.nama);
                $('#editRekrutmen input[name="alamat"]').val(data.alamat);
                $('#editRekrutmen input[name="nomorTelepon"]').val(data.nomor_telepon);
                $('#editRekrutmen input[name="statusRekrutmen"]').val(data.status_rekrutmen);
                $('#editRekrutmen input[name="keahlian"]').val(data.keahlian);
                $('#editRekrutmen input[name="catatan"]').val(data.catatan);

                var updateRoute = "{{ route('rekrutmen.update', ':id') }}";
                updateRoute.replace(':id', data.id_rekrutmen);

                // Set form action URL dynamically
                var actionUrl = '/rekrutmen/' + data.id_rekrutmen;
                $('#editRekrutmen form').attr('action', actionUrl);

            });

            // show form with bootstrap modal
            $('#dataRekrutmenTable').on('click', '.btn-show', function(event) {
                event.preventDefault();
                var $tr = $(this).closest('tr');
                if ($tr.hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();

                // Populate your show modal with data
                $('#showRekrutmen input[name="id"]').val(data.id_rekrutmen);
                $('#showRekrutmen input[name="nama"]').val(data.nama);
                $('#showRekrutmen input[name="alamat"]').val(data.alamat);
                $('#showRekrutmen input[name="nomorTelepon"]').val(data.nomor_telepon);
                $('#showRekrutmen input[name="statusRekrutmen"]').val(data.status_rekrutmen);
                $('#showRekrutmen input[name="keahlian"]').val(data.keahlian);
                $('#showRekrutmen input[name="catatan"]').val(data.catatan);

                console.log(data.id_rekrutmen);

                var updateRoute = "{{ route('rekrutmen.statusRekrutmenQuery', ':id') }}";
                updateRoute = updateRoute.replace(':id', data.id_rekrutmen); // Perubahan ini harus disimpan

                // Set form action URL dynamically
                var actionUrl = '/statusRekrutmenQuery/' + data.id_rekrutmen;
                $('#showRekrutmen form').attr('action', actionUrl);
            });

            // Menangani klik pada tombol tolak, terima, dan proses pada detail modal
            $('#statusRekrutmenQueryForm .btnquery').click(function() {

                var buttonValue = $(this).val(); // Mendapatkan nilai tombol yang diklik
                $('#button_value').val(buttonValue); // Mengatur nilai input hidden
                // Melakukan submit form
                var form = $(this).closest("form");
                form.submit();
            });


            // delete confirmation with sweetalert by realrashid
            $(".datatable").on("click", ".btn-delete", function(e) {
                e.preventDefault();
                var form = $(this).closest("form");
                var nama = $(this).data("nama");

                Swal.fire({
                    title: "Yakin ingin menghapus \n" + nama + "?",
                    text: "Anda tidak bisa mengembalikan data yang telah terhapus!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "bg-primary",
                    confirmButtonText: "Ya, hapus data!",
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
