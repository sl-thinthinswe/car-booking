<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="fantube">
    <meta name="author" content="fantube">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/fantube.png')}}">
    <title>FanTube</title>
    {{-- <link href="{{asset('css/libs/bootstrap/bootstrap.min.css')}}" rel="stylesheet" /> --}}
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom/all.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/libs/fontawesome-free-6.7.2/css/all.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/libs/select2/select-2.min.css') }}" rel="stylesheet">

</head>

<body>
   {{-- @include('layout.header')÷ --}}
   <div>
            @yield('content')

    </div>
    
    
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/select2/select-2.min.js') }}"></script>
    <script src="{{ asset('js/custom/all.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.select2').select2();
            $('.select2-container--default .select2-selection--single,.select2-selection__arrow').css({
                height: '40px',
                textAlign: 'left',
                paddingTop: '5px',
                lineHeight: '40px' // Adjust to match the height
            });
            $(".select2-container--default").css({
                width: '100%'
            })
        });
    </script>
    

    @yield('js')
    
</body>
</html>
