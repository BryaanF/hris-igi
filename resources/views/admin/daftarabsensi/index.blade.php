@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mt-3 mb-3">
            <div class="card-header">Daftar Absensi Karyawan</div>
            <div class="card-body d-flex justify-content-end">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
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
                    <button type="button" class="btn btn-secondary" data-bs-target="#tanggalModal" data-bs-toggle="modal">
                        <i class="bi bi-plus-circle me-1"></i><span>Generate Absensi</span>
                    </button>
                    <a href="{{ route('daftarabsensi.absensi') }}" class="btn btn-primary" id="absensiButton">
                        <i class="bi bi-plus-circle me-1"></i><span>Absensi</span>
                    </a>
                    </li>
                </ul>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable"
                    id="dataDaftarAbsensiTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Nama Karyawan</th>
                            <th>Status Absensi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>

    <!-- Modal Tanggal -->
    <div class="modal fade" id="tanggalModal" tabindex="-1" aria-labelledby="tanggalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tanggalModalLabel">Pilih Tanggal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('daftarabsensi.generateAbsenceData') }}" method="POST" id="generateAbsensiForm">
                    @csrf
                    <div class="modal-body">
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal"
                            name="tanggal">
                        @error('tanggal')
                            <div class="text-danger">
                                <small>{{ $message }}</small>
                            </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="generateAbsensiButton">Generate</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function() {
            var table = $("#dataDaftarAbsensiTable").DataTable({
                serverSide: true,
                processing: true,
                ajax: "/getDaftarAbsensi",
                columns: [{
                        data: "id_absensi",
                        name: "id_absensi",
                        visible: false
                    },
                    {
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "tanggal",
                        name: "tanggal"
                    },
                    {
                        data: "jam_masuk",
                        name: "jam_masuk"
                    },
                    {
                        data: "nama_karyawan",
                        name: "data_karyawan.nama"
                    },
                    {
                        data: "status_absensi",
                        name: "status_absensi"
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
                pageLength: 50, // Menentukan default jumlah data yang ditampilkan
                language: {
                    emptyTable: "Belum terdapat data absensi yang tercatat!"
                }
            });

            // Membuka modal secara langsung jika ada error pada input di modal create dan edit
            @if (!empty(Session::get('error_in_modal')) && Session::get('error_in_modal') == 1)
                $('#tanggalModal').modal('show');
            @endif

            // Menangani klik tombol Generate pada modal
            $('#generateAbsensiButton').click(function() {
                var tanggal = $('#tanggal').val(); // Dapatkan tanggal yang dipilih
                if (tanggal === "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Silakan pilih tanggal terlebih dahulu.'
                    });
                    return;
                }

                $('#generateAbsensiForm').submit(); // Submit form
                $('#tanggalModal').modal('hide'); // Sembunyikan modal
            });

            // konfirmasi ke halaman absensi
            $('#absensiButton').click(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Apakah Anda yakin akses halaman absensi?',
                    text: "Anda akan logout dari sistem dan akan berpindah ke halaman absensi.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, lanjutkan!',
                    cancelButtonText: "Tidak, kembali!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = $(this).attr('href');
                    }
                });
            });

            // delete confirmation with sweetalert by realrashid
            $(".datatable").on("click", ".btn-delete", function(e) {
                e.preventDefault();
                var form = $(this).closest("form");
                var nama = $(this).data("nama");

                Swal.fire({
                    title: "Apakah anda yakin ingin menghapus data absensi?",
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
