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
                        <a href="" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Data Rekrutmen
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                {{-- {{ $dataTable->table() }} --}}
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
        });
    </script>
@endpush
