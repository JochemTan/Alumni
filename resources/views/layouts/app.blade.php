<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/main.css">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    @yield('css')
</head>
<body id="app-layout">

    @yield('nav')

    @if (session('msg-danger'))
        <div class="alert alert-danger">
            <strong>Mislukt:</strong> {{Session::get('msg-danger')}}
        </div>
    @endif
    @if (Session::has('msg-success'))
        <div class="alert alert-success">
            <strong>Gelukt:</strong> {{Session::get('msg-success')}}
        </div>
    @endif

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <script>
        $(document).ready(function(){
           $('#filterButton').click(function(){
                $('.filterlist').toggle();
           });

            $("#filter_table tr").click(function () {     // function_tr
                var tdata = $(this).find('td:nth-child(3)').text();
                var searchfield =  $("#searchField");
                searchfield.val(searchfield.val()+tdata);
                searchfield.focus();
                console.log('You clicked ' + tdata);
            });
        });
    </script>
    @yield('extraJs')
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @yield('js')

</body>
@yield('footer')
</html>
