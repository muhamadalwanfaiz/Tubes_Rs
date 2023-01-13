<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        .judul {
            margin-top: 50px;
            font-family: 'Times New Roman', Times, serif;
            font-weight: bolder;
        }
        .judul p {
            font-size: 20px;
        }
        .tgl p {
            font-family: 'Times New Roman', Times, serif;
            font-size: 1em;
            margin-top: 10px;
        }
        #tanggal {
            font-family: 'Times New Roman', Times, serif;
            font-size: 1em;
        }
        .judul-dok {
            margin-top: 50px;
        }
        .judul-dok p {
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif;
        }
        .line {
            width: 100%;
            height: 5px;
            background-color: black;
            margin-top: 20px;
        }
        
        .table-pasien {
            font-family: 'Times New Roman', Times, serif;
            font-size: 1em;
        }
        .table-pasien td {
            padding-right: 30px;
            padding-top: 10px;
        }
        .judul-pasien p {
            font-family: 'Times New Roman', Times, serif;
            font-size: 20px;
            margin-top: 30px;
        }
        .table-dokter {
            font-family: 'Times New Roman', Times, serif;
            font-size: 1em;
        }
        .table-dokter td {
            padding-right: 30px;
        }
        .tx-ket p {
            font-family: 'Times New Roman', Times, serif;
            font-size: 1em;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="judul text-center">
            <h1>Klinik Sehat</h1>
            <p>Kunjungan Pasien</p>
            <h2 class="line"></h2>
        </div>
        <div class="judul-pasien">
            <p>Data Diri Pasien</p>
            <h2 class="line"></h2>
        </div>
        <div class="isi-pasiens">
            <table class="table-pasien">
                <tr>
                    <td>Kode Pasien</td>
                    <td>:</td>
                    <td>{{ $kunjungans['relationToPasien']['kodePasien'] }}</td>
                </tr>
                <tr>
                    <td>Nama Pasien</td>
                    <td>:</td>
                    <td>{{ $kunjungans['relationToPasien']['nama'] }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{ $kunjungans['relationToPasien']['gender'] }}</td>
                </tr>
                <tr>
                    <td>Umur</td>
                    <td>:</td>
                    <td>{{ $kunjungans['relationToPasien']['umur'] }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>{{ $kunjungans['relationToPasien']['alamat'] }}</td>
                </tr>
                <tr>
                    <td>No.Hanphone</td>
                    <td>:</td>
                    <td>{{ $kunjungans['relationToPasien']['noHp'] }}</td>
                </tr>
            </table>
        </div>
        <div class="judul-dok">
            <p>Dengan Dokter dan Spesialis</p>
            <h2 class="line"></h2>
        </div>
        <div class="isi-dokter py-2">
            <table class="table-dokter">
                <tr>
                    <td>Nama</td>
                    <td style="padding-right: 50px;">:</td>
                    <td>{{ $kunjungans['relationToDokter']['nama'] }}</td>
                </tr>
                <tr>
                    <td>Spesialis</td>
                    <td style="padding-right: 50px;">:</td>
                    <td>{{ $kunjungans['relationToDokter']['spesialis'] }}</td>
                </tr>
            </table>
        </div>
        <div class="judul-dok">
            <p>Keterangan Tentang Pasien</p>
            <h2 class="line"></h2>
        </div>
        <div class="tx-ket">
            <p>{{ $kunjungans['keterangan'] }}</p>
        </div>
    </div>
</body>
</html>