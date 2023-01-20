@extends('adminlte::page')

@section('title', 'RS sehat')

@section('content_header')
    <h1>Data Pembayaran</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            {{ __('Pengelolaan Pembayaran') }}
        </div>
        <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahPembayaranModal">
                <i class="fa fa-plus"></i>Tambah Data
            </button>
            <a href="{{ route('admin.pembayaran.export') }}" class="btn btn-info" target="_blank">
                <i class="fa fa-file mx-1"></i>Export</a>
            <a href="{{ route('admin.pembayaran.pdf') }}" class="btn btn-secondary">
                <i class="fa fa-print mx-1"></i>Cetak PDF
            </a>
        <hr/>
            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>KODE PASIEN</th>
                        <th>NAMA PASIEN</th>
                        <th>ALAMAT PASIEN</th>
                        <th>NAMA DOKTER</th>
                        <th>SPESIALIS DOKTER</th>
                        <th>NO REKENING</th>
                        <th>JUMLAH PEMBAYARAN</th>
                        <th>BUKTI PEMBAYARAN</th>
                        <th>STATUS</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach($pembayarans as $pembayaran)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$pembayaran->relationToKunjungan->relationToPasien->kodePasien}}</td>
                            <td>{{$pembayaran->relationToKunjungan->relationToPasien->nama}}</td>
                            <td>{{$pembayaran->relationToKunjungan->relationToPasien->alamat}}</td>
                            <td>{{$pembayaran->relationToKunjungan->relationToDokter->nama}}</td>
                            <td>{{$pembayaran->relationToKunjungan->relationToDokter->spesialis}}</td>
                            <td>{{$pembayaran->noRek}}</td>
                            <td>{{$pembayaran->jmlPembayaran}}</td>
                            <td>
                                @if($pembayaran->buktiPembayaran !== null)
                                    <img src="{{asset('storage/bkt_bayar/'.$pembayaran->buktiPembayaran)}}" width="100px">
                                @else
                                        [Gambar Tidak Tersedia]
                                @endif
                            </td>
                            <td>{{$pembayaran->status}}</td>
                            <td>
                                <button type="button" id="btn-edit-pembayaran" class="btn btn-success" data-toggle="modal" data-target="#editPembayaranModal" data-id="{{ $pembayaran->id }}">Edit</button>
                                <button type="button" id="btn-delete-dokter" class="btn btn-danger" onclick="deleteConfirmation('{{ $pembayaran->id }}' , '{{ $pembayaran->relationToKunjungan->relationToPasien->nama }}' , '{{ $pembayaran->noRek }}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- TAMBAH DATA PEMBAYARAN --}}
<div class="modal fade" id="tambahPembayaranModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-users mx-2"></i>Tambah Data Pemabayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route ('admin.pembayaran.submit') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="kunjungans_id">Nama Pasien</label>
                            <select name="kunjungans_id" class="form-control" id="kunjungans_id">
                                <option value="" hidden></option>
                                @foreach($kunjungans as $key => $value)
                                    <option value="{{ $value->id}}">{{ $value->relationToPasien->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="noRek">No Rekening</label>
                            <input type="text" class="form-control" name="noRek" id="noRek" required>
                        </div>
                        <div class="form-group">
                            <label for="jmlPembayaran">Jumlah Pembayaran</label>
                            <input type="text" class="form-control" name="jmlPembayaran" id="jmlPembayaran" required>
                        </div>
                        <div class="form-group">
                            <label for="buktiPembayaran">Bukti Pembayaran</label>
                             <input type="file"class="form-control h-auto" name="buktiPembayaran" id="buktiPembayaran" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                             <input type="text" class="form-control" name="status" id="status">
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


{{-- UPADATE DATA PEMBAYARAN --}}
<div class="modal fade" id="editPembayaranModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Pemabayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('admin.pembayaran.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="edit-noRek">No Rekening</label>
                                <input type="text" class="form-control" name="noRek" id="edit-noRek" required>
                            </div>
                            <div class="form-group">
                                <label for="edit-jmlPembayaran">Jumlah Pembayaran</label>
                                <input type="text" class="form-control" name="jmlPembayaran" id="edit-jmlPembayaran" required>
                            </div>
                            <div class="form-group">
                                <label for="buktiPembayaran">Bukti Pembayaran</label>
                                 <input type="file"class="form-control h-auto" name="buktiPembayaran" id="edit-buktiPembayaran">
                            </div>
                            <div class="form-group">
                                <label for="edit-status">Status</label>
                                 <input type="text" class="form-control" name="status" id="edit-status" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="edit-id">
                        <input type="hidden" name="old_buktiPembayaran" id="edit-old-buktiPembayaran">
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
        // MENGAMBIL VALUE DARI PEMBAYARAN
        $(function(){
            $(document).on('click','#btn-edit-pembayaran', function(){
                let id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "{{url('/admin/ajaxadmin/dataPembayaran')}}/" + id,
                    datatype: 'json',
                    success: function(res){
                        $('#edit-noRek').val(res.noRek);
                        $('#edit-jmlPembayaran').val(res.jmlPembayaran);
                        $('#edit-status').val(res.status)
                        $('#edit-id').val(res.id);
                        $('#edit-old-buktiPembayaran').val(res.buktiPembayaran);
                    },
                });
            });
        });


         //FUNCTION DELETE DATA PEMBAYARAN
        function deleteConfirmation(npm, nama, noRek) {
            swal.fire({
                title: "Hapus",
                type: 'warning',
                text: "Apakah anda yakin akan menghapus data Pembayaran dengan Nama Pasien " + nama +" dengan No.Rekening " + noRek + " ?!",
                showCancelButton: !0,
                confirmButtonText: "Ya lakukan",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: !0
            }).then(function (e) {
                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "pembayarans/delete/"+ npm,
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
@endsection