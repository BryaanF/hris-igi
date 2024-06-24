@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10 mt-3 mb-3">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body" style="overflow-x: auto;">
                    @if (session('status'))
                        <div class="alert alert-success text-center" role="alert">
                            <h6>Selamat Datang di Sistem Informasi Sumber Daya Manusia PT. Indo Global Impex </h6>

                            {{ session('status') }}
                        </div>
                    @endif
                    <h1 class="text-center">Absensi Hari Ini</h1>
                    <h6 class="fst-italic text-center">Tanggal {{ $tanggalsaatini }}</h6>
                    <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable"
                        id="dataDaftarAbsensiHariIniTable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>No</th>
                                <th>Jam Masuk</th>
                                <th>Nama Karyawan</th>
                                <th>Status Absensi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function() {
            var table = $("#dataDaftarAbsensiHariIniTable").DataTable({
                serverSide: true,
                processing: true,
                ajax: "/getAbsensiHariIni",
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
                        data: "jam_masuk",
                        name: "jam_masuk"
                    },
                    {
                        data: "nama_karyawan",
                        name: "nama_karyawan"
                    },
                    {
                        data: "status_absensi",
                        name: "status_absensi"
                    }
                ],
                order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"],
                ],
                pageLength: 50,
                language: {
                    emptyTable: "Belum terdapat data absensi yang tercatat!"
                }
            });

            // reload setiap sekitar 7 detik untuk datatables
            setInterval(function() {
                table.ajax.reload(null, false); // hanya reload data pada datatables
            }, 7500);

        });
    </script>
@endpush
