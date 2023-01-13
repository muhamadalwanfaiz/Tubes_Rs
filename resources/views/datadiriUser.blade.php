@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <h1>Form Pengisian Data Diri</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-users mx-2"></i>Isi Data Diri</h5>
            </div>
            <div class="modal-body">
                    <form method="post" action="{{ route ('user.datadiri.submit') }}" enctype="multipart/form-data">
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
                            <button type="submit" class="btn btn-success">Kirim</button>
                            <button type="button" class="btn btn-primary" id="btn-submit-pendaftaran" data-toggle="modal" data-target="#tambahPendaftaranModal" >
                                <i class="fa fa-plus mx-2"></i>Daftar Periksa
                            </button>
                    </form>
                </div>
                <hr/>
            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>Kode Pasien</th>
                        <th>Nama Pasien</th>
                        <th>Spesialis</th>
                        <th>Keterangan</th>  
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach($kunjungans as $kunjungan)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$kunjungan->relationToPasien->kodePasien}}</td>
                            <td>{{$kunjungan->relationToPasien->nama}}</td>
                            <td>{{$kunjungan->relationToDokter->spesialis}}</td>
                            <td>{{$kunjungan->keterangan}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- TAMBAH DATA PENDAFTARAN --}}
<div class="modal fade" id="tambahPendaftaranModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-scroll mx-2"></i>Form Pendaftaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> 
            </div>
            <div class="modal-body">
                <p>Harap isi data diri terlebih dahulu sebelum melakukan pendaftaran!</p>
                <hr>
                <form method="post" action="{{ route ('user.pendaftaran.submit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="submit-kodePasien">Kode Pasien</label>
                        <input type="text" class="form-control" name="kodePasien" id="submit-kodePasien" readonly>
                    </div>
                    <div class="form-group">
                        <label for="submit-nama">Nama Pasien</label>
                        <input type="text" class="form-control" name="namaPasien" id="submit-nama" readonly>
                    </div>
                    <div class="form-group">
                        <label for="dokters_id">Spesialis</label>
                        <select name="dokters_id" class="form-control" id="dokters_id">
                            <option value="" hidden></option>
                            @foreach($dokters as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->spesialis }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="5" class="form-control"></textarea>
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
@stop

@section('js')
    <script>
         // MENGAMBIL VALUE DARI PASIEN UNTUK PENDAFTARAN
         $(function(){
            $(document).on('click','#btn-submit-pendaftaran', function(){
                let id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "{{url('/admin/ajaxadmin/pendaftaran')}}/" + id,
                    datatype: 'json',
                    success: function(res){
                        $('#submit-kodePasien').val(res.kodePasien);
                        $('#submit-nama').val(res.nama);
                        $('#submit-id').val(res.id);
                    },
                });
            });
        });
    </script>
@stop