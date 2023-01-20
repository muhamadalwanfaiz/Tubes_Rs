@extends('adminlte::page')

@section('title', 'RS Sehat')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Welcome') }}</div>

                <div class="card-body">
                    @if ($user->roles_id == 1)
                        Hai, Selamat Datang Admin Selamat Bekerja
                    @else
                        Hai, Selamat Datang di Website Klinik Sehat
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
