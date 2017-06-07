<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Windesheim Flevoland</title>
    {{-- bootstrap --}}
   	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    {{-- customcss --}}
   	@yield('css')
    {{-- fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700|Source+Sans+Pro:400,600" rel="stylesheet">
   	<body>
   		@yield('content')
      @yield('javascript')
   	</body>
   	</html>