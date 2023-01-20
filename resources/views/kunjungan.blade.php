@extends('adminlte::page')

@section('title', 'Home Page')

@section('content_header')
    <h1>Data Kunjungan</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            {{ __('Pengelolaan Kunjungan') }}
        </div>
        <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahKunjunganModal">
                <i class="fa fa-plus mx-2"></i>Tambah Data
            </button>
            <a href="{{ route('admin.kunjungan.export') }}" class="btn btn-info" target="_blank">
                <i class="fa fa-file mx-1"></i>Export</a>
            <hr>
            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>KODE PASIEN</th>
                        <th>NAMA PASIEN</th>
                        <th>JENIS KELAMIN</th>
                        <th>UMUR</th>
                        <th>ALAMAT</th>
                        <th>NO HANPHONE</th>
                        <th>NAMA DOKTER</th>
                        <th>SPESIALIS</th>
                        <th>HARGA PERIKSA</th>
                        <th>KETERANGAN</th>
                        <th>AKSI</th>
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
                            <td>{{$kunjungan->relationToPasien->gender}}</td>
                            <td>{{$kunjungan->relationToPasien->umur}}</td>
                            <td>{{$kunjungan->relationToPasien->alamat}}</td>
                            <td>{{$kunjungan->relationToPasien->noHp}}</td>
                            <td>{{$kunjungan->relationToDokter->nama}}</td>
                            <td>{{$kunjungan->relationToDokter->spesialis}}</td>
                            <td>{{$kunjungan->relationToDokter->harga}}</td>
                            <td>{{$kunjungan->keterangan}}</td>
                            <td>
                                <a href="{{ route('admin.kunjungan.pdf', $kunjungan->id) }}" class="btn btn-warning" target="_blank">Cetak</a>
                                <button type="button" id="btn-edit-kunjungan" class="btn btn-success" data-toggle="modal" data-target="#editKunjunganModal" data-id="{{ $kunjungan->id }}">Edit</button>
                                <button type="button" id="btn-delete-kunjungan" class="btn btn-danger" onclick="deleteConfirmation('{{ $kunjungan->id }}' , '{{ $kunjungan->relationToPasien->kodePasien }}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


{{-- TAMBAH DATA KUNJUNGAN --}}
<div class="modal fade" id="tambahKunjunganModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-users mx-2"></i>Tambah Data Kunjungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route ('admin.kunjungan.submit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="pasiens_id">Nama Pasien</label>
                        <select name="pasiens_id" class="form-control" id="pasiens_id">
                            <option value="" hidden></option>
                            @foreach($pasiens as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->nama }}</option>
                            @endforeach
                        </select>
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

{{-- UPADATE DATA KUNJUNGAN --}}
<div class="modal fade" id="editKunjunganModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Kunjungan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.kunjungan.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit-keterangan">Keterangan</label>
                                <textarea name="keterangan" id="edit-keterangan" rows="10" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="edit-id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>

        // MENGAMBIL VALUE DARI KUNJUNGAN
        $(function(){
            $(document).on('click','#btn-edit-kunjungan', function(){
                let id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "{{url('/admin/ajaxadmin/dataKunjungan')}}/" + id,
                    datatype: 'json',
                    success: function(res){
                        $('#edit-keterangan').val(res.keterangan);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });

        // FUNCTION DELETE PADA PASIEN 
        function deleteConfirmation(npm, kodePasien) {
            swal.fire({
                title: "Hapus",
                type: 'warning',
                text: "Apakah anda yakin akan menghapus data Kunjungan dengan KodePasien " + kodePasien +"?!",
                showCancelButton: !0,
                confirmButtonText: "Ya lakukan",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "kunjungans/delete/"+ npm,
                        data: {_token: CSRF_TOKEN},
                        datatype: 'JSON',
                        success: function (results) {
                            if (results.success === true) {
                                swal.fire("Done!", results.message, "success");
                                // REFRESH PAGE AFTER 2
                                setTimeout(function(){
                                    location.reload();
                                },1000);
                            } else {
                                swal.fire("Error!", results.message, "error");
                            }
                        }
                    });
                } else {
                    e.dismiss;
                }
            }, function (dismiss) {
                return false;
            })
        }
    </script>
@stop