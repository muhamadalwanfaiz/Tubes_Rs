@extends('adminlte::page')

@section('title', 'Home Page')

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
            <table id="table-data" class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>SPESIALIS</th>
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
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection