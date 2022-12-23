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
            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
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
                            <td>{{$pasien->nama}}</td>
                            <td>{{$pasien->gender}}</td>
                            <td>{{$pasien->umur}}</td>
                            <td>{{$pasien->alamat}}</td>
                            <td>{{$pasien->noHp}}</td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection