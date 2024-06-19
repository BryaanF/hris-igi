@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mt-3 mb-3">
            <div class="card-header">Penggajian / Payroll</div>
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
                    <button type="button" class="btn btn-secondary" data-bs-target="#bulanModal" data-bs-toggle="modal">
                        <i class="bi bi-plus-circle me-1"></i><span>Generate Gaji</span>
                    </button>
                    </li>
                </ul>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable"
                    id="dataPenggajianTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>No</th>
                            <th>Nama Karyawan</th>
                            <th>Gaji Pokok</th>
                            <th>Potongan</th>
                            <th>Tunjangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>

    <!-- Modal Bulan -->
    <div class="modal fade" id="bulanModal" tabindex="-1" aria-labelledby="bulanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bulanModalLabel">Pilih Bulan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('daftarabsensi.generateAbsenceData') }}" method="POST" id="generateAbsensiForm">
                    @csrf
                    <div class="modal-body">
                        <input type="month" class="form-control @error('bulan') is-invalid @enderror" id="bulan"
                            name="bulan">
                        @error('bulan')
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
            var table = $("#dataPenggajianTable").DataTable({
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
