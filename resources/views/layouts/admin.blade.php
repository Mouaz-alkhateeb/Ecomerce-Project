<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    {{-- Fonts --}}
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="{{asset('admin/css/material-dashboard.css')}}" rel="stylesheet" />

</head>
<body>
    <div class="wrapper ">
        @include('layouts.include.sidebar')

        <div class="main-panel">

            @include('layouts.include.navbar')
                <div class="content">
                    @yield('content')
                </div>
            @include('layouts.include.footer')
        </div>
    </div>

    <script type="text/javascript" src="{{asset('admin/js/core/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/core/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/core/bootstrap-material-design.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('admin/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
     integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @if (session('status'))
        <script>
            swal("{{session('status')}}")
        </script>
    @endif

    @yield('scripts')

</body>
</html>
