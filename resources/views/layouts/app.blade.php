<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Icon -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
    <div class="bgImage" id="app">
        @include('includes.navbar')
        <div class= "mainContainerBorders colorGreenLight-op-05 container-fluid mt-4 mb-4">
            @include('includes.messages')
            @yield('content')
        </div>
        <div class="container-fluid colorGreenLight-op-05 p-2 m-0 ">
            <div class="row justify-content-center">
                {{-- image size 210x105 --}}
                <div class="col offset-md-1 b-0 p-0">
                    <div class="partnersImageSize container-flex border" style="text-align:center;">
                        <p >Partner blok, veličine 210x105 px.</p>
                    </div>
                </div>
                <div class="col b-0 p-0">
                    <div class="partnersImageSize container-flex border" style="text-align:center;">
                        <p >Partner blok, veličine 210x105 px.</p>
                    </div>
                </div>
                <div class="col b-0 p-0">
                    <div class="partnersImageSize container-flex border" style="text-align:center;">
                        <p >Partner blok, veličine 210x105 px.</p>
                    </div>
                </div>
                <div class="col b-0 p-0">
                    <div class="partnersImageSize container-flex border" style="text-align:center;">
                        <p >Partner blok, veličine 210x105 px.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
