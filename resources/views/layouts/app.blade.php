<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Human Resources Information System PT. IGI - Admin / Employee</title>
    <link rel="shortcut icon" href="{{ asset('igi_logo.png') }}" type="image/x-icon">
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/css/dashboard.css'])
</head>

<body class="h-100">
    @include('layouts.header')
    <div class="container-fluid">
        <div class="row">
            @include('layouts.sidenav')
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                {{-- <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"> --}}
                @yield('content')
                {{-- </div> --}}
            </main>
        </div>
    </div>
    @vite('resources/js/app.js')
    @include('sweetalert::alert')
    @stack('scripts')

</body>

</html>
