@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <h1>Data Pasien</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            {{ __('Pengelolaan Pasien') }}
        </div>
        <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahPasienModal">
                <i class="fa fa-plus"></i>Tambah Data
            </button>
            <hr/>
            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>KODE PASIEN</th>
                        <th>NAMA</th>
                        <th>JENIS KELAMIN</th>
                        <th>UMUR</th>
                        <th>ALAMAT</th>
                        <th>NO HANDPHONE</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach($pasiens as $pasien)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$pasien->kodePasien}}</td>
                            <td>{{$pasien->nama}}</td>
                            <td>{{$pasien->gender}}</td>
                            <td>{{$pasien->umur}}</td>
                            <td>{{$pasien->alamat}}</td>
                            <td>{{$pasien->noHp}}</td>
                            <td>
                                <button class="btn btn-success">Edit</button>
                                <button class="btn btn-danger">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahPasienModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-users mx-2"></i>Tambah Data Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route ('admin.pasien.submit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="kodePasien">Kode Pasien</label>
                        <input type="text" class="form-control" name="kodePasien" id="kodePasien" value="{{ $nomer }}" readonly>
                    </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="gender" id="gender">
                                <option>Laki-Laki</option>
                                <option>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="umur">Umur</label>
                            <input type="year" class="form-control" name="umur" id="umur" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="alamat" id="alamat" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="noHp">No. handphone</label>
                            <input type="text" class="form-control" name="noHp" id="noHp" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection