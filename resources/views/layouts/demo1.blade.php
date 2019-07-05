<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
<div class="bg-primary text-white text-center" style="height: 100px; width: 100%;">Đỗ Hoàng Long <div><a class="text-white" href="/yield_b">yield b</a></div>
  <div><a class="text-white" href="/yield_c" >yield c</a></div></div>
@section('top-bar')
  <div>Ththis is top bar</div>

@stop
@yield('top-bar')
@yield('a')
@yield('b')
@yield('c')
</body>
</html>


