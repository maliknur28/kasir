<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kasir</title>

    <link rel="stylesheet" href="{{ asset('assets/bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/font-google/poppins.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/font-google/poppins.min.css') }}">
    <script src="{{ asset('assets/library/jquery-3.7.1.min.js') }}"></script>
</head>

<body class="bg-body-secondary poppins-regular">
    
    @include('sweetalert::alert')
    
    @yield('asset')
    
    
    <script src="{{ asset('assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>

    @include('assets.script')
</body>

</html>
