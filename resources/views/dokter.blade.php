@extends('adminlte::page')

@section('title', 'RS sehat')

@section('content_header')
    <h1>Data Dokter</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            {{ __('Pengelolaan Dokter') }}
        </div>
        <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahDokterModal">
                <i class="fa fa-plus"></i>Tambah Data
            </button>
            <a href="{{ route('admin.dokter.export') }}" class="btn btn-info"><i class="fa fa-file mx-1"></i>Export</a>
        <hr/>
            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>SPESIALIS</th>
                        <th>HARGA PERIKSA</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach($dokters as $dokter)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$dokter->nama}}</td>
                            <td>{{$dokter->spesialis}}</td>
                            <td>{{$dokter->harga}}</td>
                            <td>
                                <button type="button" id="btn-edit-dokter" class="btn btn-success" data-toggle="modal" data-target="#editDokterModal" data-id="{{ $dokter->id }}">Edit</button>
                                <button type="button" id="btn-delete-dokter" class="btn btn-danger" onclick="deleteConfirmation('{{$dokter->id}}','{{$dokter->nama}}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- TAMBAH DATA DOKTER --}}
<div class="modal fade" id="tambahDokterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-users mx-2"></i>Tambah Data Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route ('admin.dokter.submit') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="spesialis">Spesialis</label>
                            <input type="text" class="form-control" name="spesialis" id="spesialis" required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga Periksa</label>
                            <input type="text" class="form-control" name="harga" id="harga" required>
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

{{-- UPADATE DATA PASIEN --}}
<div class="modal fade" id="editDokterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Dokter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.dokter.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit-nama">Nama</label>
                                <input type="text" class="form-control" name="nama" id="edit-nama" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-spesialis">Spesialis</label>
                                <input type="text" class="form-control" name="spesialis" id="edit-spesialis" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-harga">Harga Periksa</label>
                                <input type="text" class="form-control" name="harga" id="edit-harga" required>
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

        // MENGAMBIL VALUE DARI PASIEN
        $(function(){
            $(document).on('click','#btn-edit-dokter', function(){
                let id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "{{url('/admin/ajaxadmin/dataDokter')}}/" + id,
                    datatype: 'json',
                    success: function(res){
                        $('#edit-nama').val(res.nama);
                        $('#edit-spesialis').val(res.spesialis);
                        $('#edit-harga').val(res.harga)
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });

        //FUNCTION DELETE DATA DOKTER
        function deleteConfirmation(npm, nama) {
            swal.fire({
                title: "Hapus",
                type: 'warning',
                text: "Apakah anda yakin akan menghapus data Dokter dengan Nama " + nama +"?!",
                showCancelButton: !0,
                confirmButtonText: "Ya lakukan",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "dokters/delete/"+ npm,
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