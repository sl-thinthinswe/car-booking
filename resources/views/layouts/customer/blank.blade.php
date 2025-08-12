<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Payment')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    @stack('styles')
</head>
<body>
    @yield('content')

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
