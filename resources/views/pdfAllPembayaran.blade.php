<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <h1 class="text-center py-5">Data Pembayaran</h1>
    <table class="table table-striped">
        <thead>
            <th>NO</th>
            <th>NAMA PASIEN</th>
            <th>ALAMAT</th>
            <th>NAMA DOKTER</th>
            <th>SPESIALIS</th>
            <th>NO REKENING</th>
            <th>JUMLAH PEMBAYARAN</th>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($pembayarans as $pembayaran)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $pembayaran->relationToKunjungan->relationToPasien->nama }}</td>
                    <td>{{ $pembayaran->relationToKunjungan->relationToPasien->alamat }}</td>
                    <td>{{ $pembayaran->relationToKunjungan->relationToDokter->nama }}</td>
                    <td>{{ $pembayaran->relationToKunjungan->relationToDokter->spesialis }}</td>
                    <td>{{ $pembayaran->noRek }}</td>
                    <td>{{ $pembayaran->jmlPembayaran }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>