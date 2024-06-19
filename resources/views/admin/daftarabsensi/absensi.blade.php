<!DOCTYPE html>
<html class="w-100 h-100">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('igi_logo.png') }}" type="image/x-icon">
    <title>Attendance</title>
    @vite('resources/js/jquery.js')
    @vite('resources/js/app.js')
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/css/dashboard.css'])
</head>

<body class="w-100 h-100 d-flex justify-content-center align-items-center">
    <div class="card text-center col-md-5">
        <div class="card-header">
            <span>Absensi</span>
        </div>
        <div class="card-body ">
            <div class="alert alert-primary fst-italic" role="alert">
                Note : Masukkan email dan password untuk absensi hari ini! Cek absensi anda pada dashboard,
                jika ada kendala silahkan hubungi admin.
            </div>
            <form method="POST" action="{{ route('daftarabsensi.absensi') }}">
                @csrf
                <div class="form-group">
                    <label for="email" class="fw-bold mb-2">Email atau Username:</label>
                    <input class="form-control @error('login') is-invalid @enderror" type="login" name="login"
                        id="login" required>
                </div>
                @error('login')
                    <div class="text-danger">
                        <small>{{ $message }}</small>
                    </div>
                @enderror
                <div class="form-group">
                    <label for="password" class="fw-bold mb-2 mt-3">Password:</label>
                    <input class="form-control" type="password" name="password" id="password" required>
                </div>
                @error('password')
                    <div class="text-danger">
                        <small>{{ $message }}</small>
                    </div>
                @enderror
                <button class="btn btn-primary col-md-8 mt-4" type="submit">Catat Kehadiran</button>
            </form>
            <hr class="w-50 border-3 rounded mx-auto" />
            <form action="{{ route('daftarabsensi.logoutAbsensi') }}" method="POST">
                @csrf
                <button class="btn btn-secondary col-md-8" type="submit">Keluar</button>
            </form>
        </div>
    </div>
    @include('sweetalert::alert')
</body>

</html>
