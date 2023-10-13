<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- Template Main CSS File -->
    <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
    <title>Laravel App - @yield('title')</title>
</head>

<body>
    {{-- Header content here --}}
    <header>
        @include('partials.header')
    </header>
    {{-- main content --}}
    @yield('content')
    {{-- Footer content here --}}
    <footer>
        @include('partials.footer')
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
