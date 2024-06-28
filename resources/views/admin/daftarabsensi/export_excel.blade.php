<table>
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
