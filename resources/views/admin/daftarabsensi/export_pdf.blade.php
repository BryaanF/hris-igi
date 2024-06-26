<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Riwayat Penggajian Karyawan</title>
    <style>
        html {
            font-size: 12px;
        }

        .table {
            border-collapse: collapse !important;
            width: 100%;
        }

        .table-bordered th,
        .table-bordered td {
            padding: 0.5rem;
            border: 1px solid black !important;
        }
    </style>
</head>

<body>
    <h1>Riwayat Penggajian Karyawan</h1>
    <h4>Mulai dari tanggal {{ $tgl_mulai_text }} sampai tanggal {{ $tgl_sampai_text }}</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Nama Karyawan</th>
                <th>Gaji Pokok</th>
                <th>Total Potongan</th>
                <th>Total Tunjangan</th>
                <th>Total Gaji</th>
                <th>Keterangan</th>
                <th>Status Gaji</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gaji as $index => $gaji)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $gaji->tanggal_digaji }}</td>
                    <td>{{ $gaji->dataKaryawan->nama }}</td>
                    <td>{{ $gaji->gaji_pokok }}</td>
                    <td>{{ $gaji->potongan }}</td>
                    <td>{{ $gaji->tunjangan }}</td>
                    <td>{{ $gaji->total_gaji }}</td>
                    <td>{{ $gaji->keterangan }}</td>
                    <td>{{ $gaji->status_gaji }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
