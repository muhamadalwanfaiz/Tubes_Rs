@extends('adminlte::page')

@section('title', 'RS sehat')

@section('content_header')
    <h1>Data Pembayaran</h1>
@stop

@section('content')
<div class="row">
    <div class="col-3">
        <div class="card card-default">
            <div class="modal-header">
                <p class="modal-title" id="exampleModalLabel"><i class="fa fa-money-bill mx-2"></i>Isi Pembayaran</p>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route ('user.pembayaran.submit') }}" enctype="multipart/form-data">
                @csrf
                    <div class="form-group">
                        <label for="pasiens_id">Nama Pasien</label>
                        <input type="text" class="form-control" value="{{ $kodepasiens->nama }}" readonly>
                        <input type="hidden" class="form-control" name="kunjungans_id" id="kunjungans_id" value="{{ $idkunjungan->id }}">
                    </div>
                    <div class="form-group">
                        <label for="noRekening">No Rekening</label>
                        <input type="text"class="form-control" name="noRek" id="noRek" required/>
                    </div>
                    <div class="form-group">
                        <label for="totalPembayaran">Isi Nominal Pembayaran</label>
                        <input type="text"class="form-control" name="jmlPembayaran" id="jmlPembayaran" required/>
                    </div>
                    <div class="form-group">
                        <label for="buktiPembayaran">Foto Bukti Pembayaran</label>
                         <input type="file"class="form-control h-auto" name="buktiPembayaran" id="buktiPembayaran" required/>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <div class="col-9">
        <div class="card card-default">
            <div class="modal-header">
                <p class="modal-title" id="exampleModalLabel">Total Pembayaran</p>
            </div>
            <div class="modal-body">
                <div class="isi-pasiens">
                    <table class="table-pasien">
                        <tr>
                            <td>Kode Pasien</td>
                            <td style="padding-right:10px; padding-left:35px;">:</td>
                            <td>{{ $idkunjungan->relationToPasien->kodePasien }}</td>
                        </tr>
                        <tr>
                            <td>Nama Pasien</td>
                            <td style="padding-right:10px; padding-left:35px;">:</td>
                            <td>{{ $idkunjungan->relationToPasien->nama }}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td style="padding-right:10px; padding-left:35px;">:</td>
                            <td>{{ $idkunjungan->relationToPasien->gender }}</td>
                        </tr>
                        <tr>
                            <td>Umur</td>
                            <td style="padding-right:10px; padding-left:35px;">:</td>
                            <td>{{ $idkunjungan->relationToPasien->umur}}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td style="padding-right:10px; padding-left:35px;">:</td>
                            <td>{{ $idkunjungan->relationToPasien->alamat }}</td>
                        </tr>
                    </table>
                    <hr>
                    <table>
                        <tr>
                            <td>Kontrol Spesialis</td>
                            <td style="padding-right:10px; padding-left:20px;">:</td>
                            <td>{{ $idkunjungan->relationToDokter->spesialis}}</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td style="padding-right:10px; padding-left:20px;">:</td>
                            <td>{{ $idkunjungan->keterangan}}</td>
                        </tr>
                        <tr>
                            <td>Harga Periksa</td>
                            <td style="padding-right:10px; padding-left:20px;">:</td>
                            <td>{{ $idkunjungan->relationToDokter->harga}}</td>
                        </tr>
                        <tr>
                            <td>Nama Dokter</td>
                            <td  style="padding-right:10px; padding-left:20px;">:</td>
                            <td>{{ $idkunjungan->relationToDokter->nama}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop