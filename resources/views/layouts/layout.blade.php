<!--
Company : Fassi Belgium
Developed : MO-Consult
Authority : Moers Serge
Date : 27-10-20
-->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if (! \Illuminate\Support\Facades\Auth::check()) class="moco-background" @endif>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Fassi Belgium CMS</title>
        <link href="{{ asset('/images/favicon.ico') }}" rel="shortcut icon" type="image/vnd.microsoft.icon" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
        <!-- Bootstrap core CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
        <!-- Datepicker -->
        <link href="{{ asset('3rd/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker3.standalone.css')}}" rel="stylesheet">
        <!-- Bootstrap-Select -->
        <link href="{{ asset('3rd/bootstrap-select-1.13.18/css/bootstrap-select.min.css')}}" rel="stylesheet">
        <!-- Ajax Bootstrap Select-->
        <link href="{{ asset('3rd/Ajax-Bootstrap-Select-1.4.5/dist/css/ajax-bootstrap-select.min.css') }}" rel="stylesheet">
        <link href="{{ asset('3rd/bttn.css-v0.2.4/bttn.css') }}" rel="stylesheet">
        <!-- CSS MOCO -->
        <link href="{{ asset('css/all.css') }}" rel="stylesheet" type="text/css">

        <!-- JQuery -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
        <!-- Datepicker-->
        <script src="{{ asset('3rd/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js')}}"></script>
        <!-- Bootstrap-Select -->
        <script type="text/javascript" src="{{asset('3rd/bootstrap-select-1.13.18/js/bootstrap-select.min.js')}}"></script>
        <!-- Ajax Bootstrap Select -->
        <script type="text/javascript" src="{{ asset('3rd/Ajax-Bootstrap-Select-1.4.5/dist/js/ajax-bootstrap-select.min.js') }}"></script>
        <!-- Handlebars-->
        <script type="text/javascript" src="{{ asset('3rd/handlebars-v4.7.6/handlebars-v4.7.6.js') }}"></script>
        <!-- Moment-->
        <script type="text/javascript" src="{{ asset('3rd/moment.2.91.1/moment.min.js') }}"></script>
        <!-- Livewire -->
        @livewireStyles



    </head>
    <body>
    <!-- affichez uniquement si l'utilisateur est authentifié -->
    @if (\Illuminate\Support\Facades\Auth::check())
        @include('menus.navbar')
    @endif
    <div class="container-fluid">
        @include('root.message')
          @yield('content')
    </div>

    <!-- affichez uniquement si l'utilisateur est authentifié -->
    @if (\Illuminate\Support\Facades\Auth::check())
    <div class="d-flex justify-content-center">
        <div>Developed by MO Consult <i class="fas fa-copyright"></i> {{ \Carbon\Carbon::now()->year }}</div>
    </div>
    @endif
    @livewireScripts
    </body>
</html>
