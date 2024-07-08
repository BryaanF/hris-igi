@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mt-3 mb-3">
            <div class="card-header">Riwayat Gaji Karyawan - {{ $satudatakaryawan->nama }}</div>
            <div class="card-body d-flex justify-content-end">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal"
                            data-bs-target="#komponenGajiKaryawanModal" id="komponenGajiKaryawanOpenModalButton">
                            <i class="bi bi-plus-circle me-1"></i><span>Komponen</span>
                        </button>
                    </li>
                    <li class="list-inline-item">
                        <button type="button" class="btn btn-primary" id="createGajiKaryawanOpenModalButton">
                            <i class="bi bi-plus-circle me-1"></i><span>Tambah</span>
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body" style="overflow-x:auto;">
                <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable"
                    id="dataPenggajianPerKaryawanTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>No.</th>
                            <th>Tahun - Bulan</th>
                            <th>Total Potongan</th>
                            <th>Total Tunjangan</th>
                            <th>Total Gaji</th>
                            <th>Status Gaji</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    {{-- Start Modal Detail / Show Gaji --}}
    <div class="modal fade" id="showPenggajianPerKaryawanModal" tabindex="-1"
        aria-labelledby="showPenggajianPerKaryawanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showPenggajianPerKaryawanModalLabel">Detail Data Penggajian -
                        {{ $satudatakaryawan->nama }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tahunBulanShow" class="form-label">Tahun - Bulan</label>
                        <input class="form-control" type="text" id="tahunBulanShow" name="tahunBulanShow" value=""
                            disabled>
                    </div>
                    <div class="form-group">
                        <label for="gajiPokokShow" class="form-label">Gaji Pokok</label>
                        <input class="form-control" type="text" id="gajiPokokShow" name="gajiPokokShow" value=""
                            disabled>
                    </div>
                    <div class="form-group">
                        <label for="potonganKetidakhadiranShow" class="form-label">Potongan Ketidakhadiran</label>
                        <input class="form-control" type="text" id="potonganKetidakhadiranShow"
                            name="potonganKetidakhadiranShow" value="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="potonganLainShow" class="form-label">Potongan Lain</label>
                        <input class="form-control" type="text" id="potonganLainShow" name="potonganLainShow"
                            value="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="totalPotonganShow" class="form-label">Total Potongan</label>
                        <input class="form-control" type="text" id="totalPotonganShow" name="totalPotonganShow"
                            value="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="totalTunjanganShow" class="form-label">Total Tunjangan</label>
                        <input class="form-control" type="text" id="totalTunjanganShow" name="totalTunjanganShow"
                            value="" disabled>
                    </div>
                    <div class="form-group">
                        <label for="totalGajiShow" class="form-label">Total Gaji</label>
                        <input class="form-control" type="text" id="totalGajiShow" name="totalGajiShow" value=""
                            disabled>
                    </div>
                    <div class="form-group">
                        <label for="keteranganShow" class="form-label">Keterangan</label>
                        <textarea class="form-control" rows="3" id="keteranganShow" name="keteranganShow" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="statusGajiShow" class="form-label">Status Gaji</label>
                        <input class="form-control" type="text" id="statusGajiShow" name="statusGajiShow" disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('penggajian.statusGajiQuery', ':id') }}" method="POST"
                        enctype="multipart/form-data" id="statusGajiQueryForm">
                        @csrf
                        <input type="hidden" name="button_value" id="button_value">
                        <button type="button" class="btn btn-success btnquery" value="Terbayar"><i
                                class="bi bi-check-circle"></i><span class="ms-1">Terbayar</span></button>
                        <button type="button" class="btn btn-warning btnquery" value="Kredit"><i
                                class="bi bi-clock"></i><span class="ms-1">Kredit</span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Detail / Show Gaji --}}

    {{-- Start Modal Edit Gaji --}}
    <div class="modal fade" id="editPenggajianPerKaryawanModal" tabindex="-1"
        aria-labelledby="editPenggajianPerKaryawanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPenggajianPerKaryawanModalLabel">Sunting Data Penggajian -
                        {{ $satudatakaryawan->nama }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('penggajian.update', ':id') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tahunBulanEdit" class="form-label">Tahun - Bulan</label>
                            <input class="form-control" type="text" id="tahunBulanEdit" name="tahunBulanEdit"
                                disabled>
                            <input type="hidden" id="tahunBulanEditHidden" name="tahunBulanEditHidden"
                                value="{{ old('tahunBulanEditHidden') }}">
                        </div>
                        <div class="form-group">
                            <label for="gajiPokokEdit" class="form-label">Gaji Pokok</label>
                            <input class="form-control @error('gajiPokokEdit') is-invalid @enderror" type="text"
                                id="gajiPokokEdit" name="gajiPokokEdit" value="{{ old('gajiPokokEdit') }}" disabled>
                            <input type="hidden" id="gajiPokokEditHidden" name="gajiPokokEditHidden"
                                value="{{ old('gajiPokokEditHidden') }}">
                            @error('gajiPokokEdit')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="potonganKetidakhadiranEdit" class="form-label">Potongan Ketidakhadiran</label>
                            <input class="form-control" type="text" id="potonganKetidakhadiranEdit"
                                name="potonganKetidakhadiranEdit" disabled>
                            <input type="hidden" id="potonganKetidakhadiranEditHidden"
                                name="potonganKetidakhadiranEditHidden"
                                value="{{ old('potonganKetidakhadiranEditHidden') }}">
                        </div>
                        <div class="form-group">
                            <label for="potonganLainEdit" class="form-label">Potongan Lain</label>
                            <input class="form-control @error('potonganLainEdit') is-invalid @enderror" type="text"
                                id="potonganLainEdit" name="potonganLainEdit" value="{{ old('potonganLainEdit') }}">
                            @error('potonganLainEdit')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="totalPotonganEdit" class="form-label">Total Potongan</label>
                            <input class="form-control @error('totalPotonganEdit') is-invalid @enderror" type="text"
                                id="totalPotonganEdit" name="totalPotonganEdit" disabled>
                            <input type="hidden" id="totalPotonganEditHidden" name="totalPotonganEditHidden"
                                value="{{ old('totalPotonganEditHidden') }}">
                        </div>
                        <div class="form-group">
                            <label for="totalTunjanganEdit" class="form-label">Total Tunjangan</label>
                            <input class="form-control @error('totalTunjanganEdit') is-invalid @enderror" type="text"
                                id="totalTunjanganEdit" name="totalTunjanganEdit"
                                value="{{ old('totalTunjanganEdit') }}">
                            @error('totalTunjanganEdit')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="totalGajiEdit" class="form-label">Total Gaji</label>
                            <input class="form-control @error('totalGajiEdit') is-invalid @enderror" type="text"
                                id="totalGajiEdit" name="totalGajiEdit" disabled>
                            <input type="hidden" id="totalGajiEditHidden" name="totalGajiEditHidden"
                                value="{{ old('totalGajiEditHidden') }}">
                        </div>
                        <div class="form-group">
                            <label for="keteranganEdit" class="form-label">Keterangan</label>
                            <textarea class="form-control @error('keteranganEdit') is-invalid @enderror" rows="3" id="keteranganEdit"
                                name="keteranganEdit">{{ old('keteranganEdit') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="statusGajiEdit" class="form-label">Status Gaji</label>
                            <input class="form-control @error('statusGajiEdit') is-invalid @enderror" type="text"
                                id="statusGajiEdit" name="statusGajiEdit" disabled>
                            <input type="hidden" id="statusGajiEditHidden" name="statusGajiEditHidden"
                                value="{{ old('statusGajiEditHidden') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="editGajiKaryawanButton">Sunting</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal Edit Gaji --}}

    <!-- Start Modal Komponen Gaji Karyawan -->
    <div class="modal fade" id="komponenGajiKaryawanModal" tabindex="-1"
        aria-labelledby="komponenGajiKaryawanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="komponenGajiKaryawanModalLabel">Komponen Gaji</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @if (empty($komponengajisatukaryawan))
                    <form action="{{ route('penggajian.storeKomponenGaji') }}" method="POST"
                        id="komponGajiKaryawanForm">
                    @else
                        <form action="{{ route('penggajian.updateKomponenGaji') }}" method="POST"
                            id="komponGajiKaryawanForm">
                @endif
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="gajiPokokKomponen">Gaji Pokok</label>
                        @if (empty($komponengajisatukaryawan))
                            <input type="number" class="form-control @error('gajiPokokKomponen') is-invalid @enderror"
                                id="gajiPokokKomponen" name="gajiPokokKomponen" value="{{ old('gajiPokokKomponen') }}">
                        @else
                            <input type="number" class="form-control @error('gajiPokokKomponen') is-invalid @enderror"
                                id="gajiPokokKomponen" name="gajiPokokKomponen"
                                value="{{ $komponengajisatukaryawan->gaji_pokok }}">
                        @endif
                        @error('gajiPokokKomponen')
                            <div class="text-danger">
                                <small>{{ $message }}</small>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" id="idKaryawan" name="idKaryawan"
                            value="{{ $satudatakaryawan->id_data_karyawan }}">
                    </div>
                </div>
                <div class="modal-footer">
                    @if (empty($komponengajisatukaryawan))
                        <button type="submit" class="btn btn-primary" id="komponenGajiKaryawanButton">Simpan</button>
                    @else
                        <button type="submit" class="btn btn-primary" id="komponenGajiKaryawanButton">Ubah</button>
                    @endif
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Komponen Gaji Karyawan -->

    <!-- Start Modal Create Gaji Karyawan -->
    <div class="modal fade" id="createGajiKaryawanModal" tabindex="-1" aria-labelledby="createGajiKaryawanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createGajiKaryawanModalLabel">Tambah Data Gaji -
                        {{ $satudatakaryawan->nama }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('penggajian.store') }}" method="POST" id="penggajianStoreForm">
                    @csrf
                    <div class="modal-body">
                        @error('error')
                            <div class="alert alert-danger" role="alert">
                                Jangan memasukkan data yang tidak sesuai sistem untuk menjaga integritas data!
                            </div>
                        @enderror
                        <div class="form-group">
                            <label for="bulanDigaji">Bulan / Tahun</label>
                            <input type="month" class="form-control @error('bulanDigaji') is-invalid @enderror"
                                id="bulanDigaji" name="bulanDigaji" value="{{ old('bulanDigaji') }}">
                            @error('bulanDigaji')
                                <div class="text-danger">
                                    <small>{{ $message }}</small>
                                </div>
                            @enderror
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="gajiPokok">Gaji Pokok</label>
                                @if (isset($komponengajisatukaryawan) && $komponengajisatukaryawan->gaji_pokok)
                                    <input type="number" class="form-control @error('gajiPokok') is-invalid @enderror"
                                        id="gajiPokok" name="gajiPokok"
                                        value="{{ $komponengajisatukaryawan->gaji_pokok }}" readonly>
                                @else
                                    <input type="number" class="form-control @error('gajiPokok') is-invalid @enderror"
                                        id="gajiPokokInvalid" name="gajiPokokInvalid" value="" readonly>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="tunjangan">Total Tunjangan</label>
                                <input type="number" class="form-control @error('tunjangan') is-invalid @enderror"
                                    id="tunjangan" name="tunjangan" value="{{ old('tunjangan') }}">
                                @error('tunjangan')
                                    <div class="text-danger">
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="potonganKetidakhadiran">Potongan Ketidakhadiran</label>
                                <input type="number"
                                    class="form-control @error('potonganKetidakhadiran') is-invalid @enderror"
                                    id="potonganKetidakhadiran" name="potonganKetidakhadiran"
                                    value="{{ old('potonganKetidakhadiranHidden') }}" readonly>
                                @error('potonganKetidakhadiran')
                                    <div class="text-danger">
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="potonganLain">Potongan Lain - Lain (selain ketidakhadiran)</label>
                                <input type="number" class="form-control @error('potonganLain') is-invalid @enderror"
                                    id="potonganLain" name="potonganLain" value="{{ old('potonganLain') }}">
                                @error('potonganLain')
                                    <div class="text-danger">
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"
                                    rows="3" value="{{ old('keterangan') }}"></textarea>
                                @error('keterangan')
                                    <div class="text-danger">
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="totalGaji">Total Gaji</label>
                                <input type="number" class="form-control" id="totalGaji" name="totalGaji"
                                    value="" readonly>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="createGajiKaryawanButton">Simpan</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Modal Create Gaji Karyawan -->
@endsection
@push('scripts')
    <script type="module">
        $(document).ready(function() {
            // show table record with datatable
            var table = $("#dataPenggajianPerKaryawanTable").DataTable({
                serverSide: true,
                processing: true,
                ajax: "/getRiwayatGajiPerKaryawan",
                columns: [{
                        data: "id_gaji",
                        name: "id_gaji",
                        visible: false
                    },
                    {
                        data: "DT_RowIndex",
                        name: "DT_RowIndex",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "tahun_bulan",
                        name: "tahun_bulan"
                    },
                    {
                        data: "total_potongan",
                        name: "total_potongan"
                    },
                    {
                        data: "total_tunjangan",
                        name: "total_tunjangan"
                    },
                    {
                        data: "total_gaji",
                        name: "total_gaji"
                    },
                    {
                        data: "status_gaji",
                        name: "status_gaji"
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
                language: {
                    emptyTable: "Belum terdapat data riwayat gaji untuk karyawan tersebut!"
                }
            });

            // membuka modal sesuai error di modal yang mana
            @if (!empty(Session::get('error_in_modal')) && Session::get('error_in_modal') == 3)
                $('#komponenGajiKaryawanModal').modal('show');
            @elseif (!empty(Session::get('error_in_modal')) && Session::get('error_in_modal') == 4)
                $('#createGajiKaryawanModal').modal('show');
            @elseif (!empty(Session::get('error_in_modal')) && Session::get('error_in_modal') == 5)
                $('#editPenggajianPerKaryawanModal').modal('show');
                $('#tahunBulanEdit').val($('#tahunBulanEditHidden').val());
                $('#gajiPokokEdit').val($('#gajiPokokEditHidden').val());
                $('#potonganKetidakhadiranEdit').val($('#potonganKetidakhadiranEditHidden').val());
                $('#totalPotonganEdit').val($('#totalPotonganEditHidden').val());
                $('#totalGajiEdit').val($('#totalGajiEditHidden').val());
                $('#statusGajiEdit').val($('#statusGajiEditHidden').val());
            @endif

            // menampilkan alert jika terdapat error sesuai dengan pesan errornya
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                });
            @endif

            // Ambil nilai gaji_pokok dari input
            var gajiPokokValue = $('#gajiPokokKomponen').val();

            // Jika gaji_pokok kosong, jangan tampilkan modal
            $('#createGajiKaryawanOpenModalButton').click(function(event) {
                if (!gajiPokokValue) {
                    event.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Gaji Pokok Tidak Tersedia',
                        text: 'Gaji Pokok tidak tersedia. Mohon isi data gaji pokok terlebih dahulu pada komponen gaji dengan klik tombol "komponen".',
                    });
                } else {
                    $('#createGajiKaryawanModal').modal('show');
                }
            });

            // untuk mengkalkulasi total gaji pada modal create
            function kalkulasiTotalGaji() {
                var gajiPokok = parseFloat($('#gajiPokok').val()) || 0;
                var potonganKetidakhadiran = parseFloat($('#potonganKetidakhadiran').val()) || 0;
                var tunjangan = parseFloat($('#tunjangan').val()) || 0;
                var potonganLain = parseFloat($('#potonganLain').val()) || 0;

                var totalGaji = gajiPokok - potonganKetidakhadiran + tunjangan - potonganLain;

                $('#totalGaji').val(totalGaji);
            }

            // untuk mengkalkulasi total gaji pada modal create
            function kalkulasiTotalGajiEdit() {
                var gajiPokok = parseFloat($('#gajiPokokEdit').val()) || 0;
                var potonganKetidakhadiran = parseFloat($('#potonganKetidakhadiranEdit').val()) || 0;
                var tunjangan = parseFloat($('#totalTunjanganEdit').val()) || 0;
                var potonganLain = parseFloat($('#potonganLainEdit').val()) || 0;

                var totalGaji = gajiPokok - potonganKetidakhadiran + tunjangan - potonganLain;

                $('#totalGajiEdit').val(totalGaji);
            }

            // jika pada bulan digaji terdapat perubahan maka potongan absensi juga menyesuaikan
            $('#bulanDigaji').on('change', function() {
                var bulanDigaji = $(this).val();
                var karyawanId =
                    "{{ $satudatakaryawan->id_data_karyawan }}"; // Ambil ID karyawan dari blade

                if (bulanDigaji) {
                    $.ajax({
                        url: "{{ route('penggajian.kalkulasiPotonganAbsensi') }}",
                        method: "GET",
                        data: {
                            bulanDigaji: bulanDigaji,
                            id: karyawanId
                        },
                        success: function(response) {
                            $('#potonganKetidakhadiran').val(response.potonganKetidakhadiran);
                            kalkulasiTotalGaji();
                        }
                    });
                }
            });

            // update kalkulasi total gaji create jika terdapat input baru pada potongan dan tunjangan
            $('#tunjangan, #potonganLain').on('input', function() {
                kalkulasiTotalGaji();
            });

            // update kalkulasi total gaji edit jika terdapat input baru pada potongan dan tunjangan
            $('#totalTunjanganEdit, #potonganLainEdit').on('input', function() {
                kalkulasiTotalGajiEdit();
            });


            // show form with bootstrap modal
            $('#dataPenggajianPerKaryawanTable').on('click', '.btn-show', function(event) {
                event.preventDefault();
                var $tr = $(this).closest('tr');
                if ($tr.hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();

                // Populate your show modal with data
                $('#showPenggajianPerKaryawanModal input[name="tahunBulanShow"]').val(data.tahun_bulan);
                $('#showPenggajianPerKaryawanModal input[name="gajiPokokShow"]').val(data.gaji_pokok);
                $('#showPenggajianPerKaryawanModal input[name="potonganKetidakhadiranShow"]').val(data
                    .potongan_ketidakhadiran);
                $('#showPenggajianPerKaryawanModal input[name="potonganLainShow"]').val(data
                    .potongan_lain);
                $('#showPenggajianPerKaryawanModal input[name="totalPotonganShow"]').val(data
                    .total_potongan);
                $('#showPenggajianPerKaryawanModal input[name="totalTunjanganShow"]').val(data
                    .total_tunjangan);
                $('#showPenggajianPerKaryawanModal input[name="totalGajiShow"]').val(data.total_gaji);
                $('#showPenggajianPerKaryawanModal textarea[name="keteranganShow"]').val(data.keterangan);
                $('#showPenggajianPerKaryawanModal input[name="statusGajiShow"]').val(data.status_gaji);

                var updateRoute = "{{ route('penggajian.statusGajiQuery', ':id') }}";
                updateRoute = updateRoute.replace(':id', data.id_gaji); // Perubahan ini harus disimpan

                // Set form action URL dynamically
                var actionUrl = '/statusGajiQuery/' + data.id_gaji;
                $('#showPenggajianPerKaryawanModal form').attr('action', actionUrl);
            });

            // Menangani klik pada tombol terbayar atau kredit pada detail modal
            $('#statusGajiQueryForm .btnquery').click(function() {
                var buttonValue = $(this).val(); // Mendapatkan nilai tombol yang diklik
                $('#button_value').val(buttonValue); // Mengatur nilai input hidden

                // Melakukan submit form
                var form = $(this).closest("form");
                form.submit();
            });

            // edit form with bootstrap modal
            $('#dataPenggajianPerKaryawanTable').on('click', '.btn-edit', function(event) {
                event.preventDefault();
                var $tr = $(this).closest('tr');
                if ($tr.hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }

                var data = table.row($tr).data();

                $('#editPenggajianPerKaryawanModal input[name="tahunBulanEdit"]').val(data.tahun_bulan);
                $('#editPenggajianPerKaryawanModal input[name="tahunBulanEditHidden"]').val(data
                    .tahun_bulan);
                $('#editPenggajianPerKaryawanModal input[name="gajiPokokEdit"]').val(data.gaji_pokok);
                $('#editPenggajianPerKaryawanModal input[name="gajiPokokEditHidden"]').val(data.gaji_pokok);
                $('#editPenggajianPerKaryawanModal input[name="potonganLainEdit"]').val(data
                    .potongan_lain);
                $('#editPenggajianPerKaryawanModal input[name="totalPotonganEdit"]').val(data
                    .total_potongan);
                $('#editPenggajianPerKaryawanModal input[name="totalPotonganEditHidden"]').val(data
                    .total_potongan);
                $('#editPenggajianPerKaryawanModal input[name="totalTunjanganEdit"]').val(data
                    .total_tunjangan);
                $('#editPenggajianPerKaryawanModal input[name="totalGajiEdit"]').val(data.total_gaji);
                $('#editPenggajianPerKaryawanModal input[name="totalGajiEditHidden"]').val(data.total_gaji);
                $('#editPenggajianPerKaryawanModal textarea[name="keteranganEdit"]').val(data
                    .keterangan);
                $('#editPenggajianPerKaryawanModal input[name="statusGajiEdit"]').val(data.status_gaji);
                $('#editPenggajianPerKaryawanModal input[name="statusGajiEditHidden"]').val(data
                    .status_gaji);

                $.ajax({
                    url: "{{ route('penggajian.kalkulasiPotonganAbsensi') }}",
                    method: "GET",
                    data: {
                        bulanDigaji: data.tahun_bulan,
                        id: data.data_karyawan.id_data_karyawan
                    },
                    success: function(response) {
                        $('#potonganKetidakhadiranEdit').val(response.potonganKetidakhadiran);
                        $('#potonganKetidakhadiranEditHidden').val(response
                            .potonganKetidakhadiran);
                        kalkulasiTotalGajiEdit();
                    }
                });

                var updateRoute = "{{ route('penggajian.update', ':id') }}";
                updateRoute = updateRoute.replace(':id', data.id_gaji); // Perubahan ini harus disimpan

                // Set form action URL dynamically
                var actionUrl = '/penggajian/' + data.id_gaji;
                $('#editPenggajianPerKaryawanModal form').attr('action', actionUrl);
            });

            // delete confirmation with sweetalert by realrashid
            $(".datatable").on("click", ".btn-delete", function(e) {
                e.preventDefault();
                var form = $(this).closest("form");

                Swal.fire({
                    title: "Apakah anda yakin ingin menghapus data gaji ini ?",
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
