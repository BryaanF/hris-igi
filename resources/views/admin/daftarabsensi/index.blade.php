@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mt-3 mb-3">
            <div class="card-header">Selamat datang di pengajuan cuti!</div>
            <div class="card-body d-flex justify-content-end">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#createPengajuanCuti">
                            <i class="bi bi-plus-circle me-1"></i><span>Buat Catatan Kehadiran Hari Ini</span>
                        </button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#presensi">
                            <i class="bi bi-plus-circle me-1"></i><span>Presensi</span>
                        </button>
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
                            <th>Mulai Cuti</th>
                            <th>Selesai Cuti</th>
                            <th>Keterangan</th>
                            <th>Status Cuti</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>

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
                        data: "id_cuti",
                        name: "id_cuti",
                        visible: false
                    },
                    {
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "mulai_cuti",
                        name: "mulai_cuti"
                    },
                    {
                        data: "selesai_cuti",
                        name: "selesai_cuti"
                    },
                    {
                        data: "keterangan",
                        name: "keterangan"
                    },
                    {
                        data: "status_cuti",
                        name: "status_cuti"
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
                language: {
                    emptyTable: "Belum terdapat data cuti yang tercatat!"
                }
            });

            // show createPengajuanCuti modal to show if controller validation pass error message
            @if ($errors->any())
                $('#createPengajuanCuti').modal('show');
            @endif

            // show form with bootstrap modal
            $('#dataPengajuanCutiTable').on('click', '.btn-show', function(event) {
                event.preventDefault();
                var $tr = $(this).closest('tr');
                if ($tr.hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();

                // Populate your show modal with data
                $('#showPengajuanCuti input[name="mulaiCuti"]').val(data.mulai_cuti);
                $('#showPengajuanCuti input[name="selesaiCuti"]').val(data.selesai_cuti);
                $('#showPengajuanCuti textarea[name="keterangan"]').val(data.keterangan);
                $('#showPengajuanCuti select[name="statusCuti"]').val(data.status_cuti);
            });

            // leave application confirmation with sweetalert by realrashid
            $(".btn-create").on("click", function(e) {
                e.preventDefault();
                var form = $(this).closest("form");

                Swal.fire({
                    title: "Yakin ingin mengajukan cuti?",
                    text: "Anda tidak bisa mengembalikan data cuti yang telah anda ajukan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "bg-primary",
                    confirmButtonText: "Ya, ajukan cuti!",
                    cancelButtonText: "Tidak, jangan ajukan!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

        });
    </script>
@endpush
