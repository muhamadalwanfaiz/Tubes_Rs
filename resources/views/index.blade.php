<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>sehat.com</title>
    <style>
        .container-fluid {
            width: 100%;
            height: 100vh;
            background: linear-gradient(252.68deg, #6dccfe 0.46%, #edf4ff 99.74%);

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .row {
            width: 80%;
        }

        .judul {
            display: flex;
        }

        .judul img {
            width: 70px;
            height: 70px;
        }

        .judul h2 {
            font-size: 50px;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
            padding-left: 10px;
        }

        .text {
            margin-top: 40px;
        }

        .text p {
            font-size: 20px;
        }

        .button {
            padding-top: 30px;
        }

        .button a {
            width: 100%;
            font-weight: bolder;
        }

        .sign-up img {
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6">
                {{-- {{ print_r(URL('')) }} --}}
                <div class="judul">
                    <img src="{{ URL('images/medicine.png') }}" alt="">
                    <h2>Sehat.com</h2>
                </div>
                <div class="text">
                    <p>Memberikan pelayanan kesehatan dengan mengunakan Aplikasi berbasis website untuk mempermudah dalam melakukan pendafataran pasien dan pembayaran.</p>
                    <p>Terdapat berbagai fitur untuk mempermudah pengguana dalam melakukan pendafataran dan juga pembayaran</p>
                </div>
                @if(Route::has('login'))
                <div class="button">
                    <div class="row">
                        <div class="col-6">
                        @auth
                            <a href="{{ route('home') }}" class="btn btn-primary">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                        </div>
                        @if(Route::has('register'))
                            <div class="col-6">
                                <a href="{{ route('register') }}" class="btn btn-success">Daftar</a>
                            </div>
                        @endif
                        @endauth
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-6">
                {{-- {{ print_r(URL('')) }} --}}
                <img src="{{ URL('images/telemedicine.png') }}" class="ms-auto d-block">
            </div>
        </div>
    </div>
</body>
</html>