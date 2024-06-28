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
                            <th>Gaji Pokok</th>
                            <th>Total Potongan</th>
                            <th>Total Tunjangan</th>
                            <th>Total Gaji</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    {{-- Start Modal Detail / Show --}}
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
                        <input class="form-control" type="text" id="keteranganShow" name="keteranganShow" value=""
                            disabled>
                    </div>
                    <div class="form-group">
                        <label for="statusGajiShow" class="form-label">Status Gaji</label>
                        <input class="form-control" type="text" id="statusGajiShow" name="statusGajiShow"
                            value="" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal Detail / Show --}}

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
                                anjayyyyy
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
                                    value="{{ old('potonganKetidakhadiran') }}" readonly>
                                @error('potonganKetidakhadiran')
                                    <div class="text-danger">
                                        <small>Ubah bulan gaji ke bulan yang berbeda dan kembalikan kembali jika perlu.
                                            Jangan merubah data ini secara manual untuk menjaga integritas data!</small>
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
                        data: "gaji_pokok",
                        name: "gaji_pokok"
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
            @if (!empty(Session::get('error_in_modal')) && Session::get('error_in_modal') == 3)
                $('#komponenGajiKaryawanModal').modal('show');
            @elseif (!empty(Session::get('error_in_modal')) && Session::get('error_in_modal') == 4)
                $('#createGajiKaryawanModal').modal('show');
            @endif

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

            // untuk mengkalkulasi total gaji
            function kalkulasiTotalGaji() {
                var gajiPokok = parseFloat($('#gajiPokok').val()) || 0;
                var potonganKetidakHadiran = parseFloat($('#potonganKetidakHadiran').val()) || 0;
                var tunjangan = parseFloat($('#tunjangan').val()) || 0;
                var potonganLain = parseFloat($('#potonganLain').val()) || 0;

                var totalGaji = gajiPokok - potonganKetidakHadiran + tunjangan - potonganLain;

                $('#totalGaji').val(totalGaji);
                $('#totalGajiHidden').val(totalGaji);
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

            // update kalkulasi total gaji jika terdapat input baru pada potongan dan tunjangan
            $('#tunjangan, #potonganLain').on('input', function() {
                kalkulasiTotalGaji();
            });

            // inisiasi pemnaggilan fungsi kalkulasi total gaji
            kalkulasiTotalGaji();

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
                $('#showPenggajianPerKaryawanModal input[name="potonganLainShow"]').val(data.potongan_lain);
                $('#showPenggajianPerKaryawanModal input[name="totalPotonganShow"]').val(data
                    .total_potongan);
                $('#showPenggajianPerKaryawanModal input[name="totalTunjanganShow"]').val(data
                    .total_tunjangan);
                $('#showPenggajianPerKaryawanModal input[name="totalGajiShow"]').val(data.total_gaji);
                $('#showPenggajianPerKaryawanModal textarea[name="keteranganShow"]').val(data.keterangan);
                $('#showPenggajianPerKaryawanModal input[name="statusGajiShow"]').val(data.status_gaji);
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
