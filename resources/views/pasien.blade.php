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
            <a href="{{ route('admin.pasien.export') }}" class="btn btn-info"><i class="fa fa-file mx-1"></i>Export</a>
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
                                <button type="button" id="btn-edit-pasien" class="btn btn-success" data-toggle="modal" data-target="#editPasienModal" data-id="{{ $pasien->id }}">Edit</button>
                                <button type="button" id="btn-delete-pasien" class="btn btn-danger" onclick="deleteConfirmation('{{$pasien->id}}','{{$pasien->nama}}')">Hapus</button>
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

{{-- UPADATE DATA PASIEN --}}
<div class="modal fade" id="editPasienModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.pasien.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit-kodePasien">Kode Pasien</label>
                                <input type="text" class="form-control" name="kodePasien" id="edit-kodePasien" readonly>
                            </div>
                            <div class="form-group">
                                <label for="edit-nama">Nama</label>
                                <input type="text" class="form-control" name="nama" id="edit-nama" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-gender">Jenis Kelamin</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="gender" id="gender">
                                    <option>Laki-Laki</option>
                                    <option>Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit-umur">Umur</label>
                                <input type="text" class="form-control" name="umur" id="edit-umur" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-alamat">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="edit-alamat" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-noHp">No Hanphone</label>
                                <input type="text" class="form-control" name="noHp" id="edit-noHp" required>
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
            $(document).on('click','#btn-edit-pasien', function(){
                let id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "{{url('/admin/ajaxadmin/dataPasien')}}/" + id,
                    datatype: 'json',
                    success: function(res){
                        $('#edit-kodePasien').val(res.kodePasien);
                        $('#edit-nama').val(res.nama);
                        $('#edit-gender').val(res.gender);
                        $('#edit-umur').val(res.umur);
                        $('#edit-alamat').val(res.alamat);
                        $('#edit-noHp').val(res.noHp);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });

        // FUNCTION DELETE PADA PASIEN 
        function deleteConfirmation(npm, nama) {
            swal.fire({
                title: "Hapus",
                type: 'warning',
                text: "Apakah anda yakin akan menghapus data Pasien dengan Nama " + nama +"?!",
                showCancelButton: !0,
                confirmButtonText: "Ya lakukan",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "pasiens/delete/"+ npm,
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