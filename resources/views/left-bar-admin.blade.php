<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  @if(Auth::check())
    <script src="{{ asset('js/autoload.js') }}" defer></script>
    <script src="{{ asset('js/sendmsg.js') }}" defer></script>
  @endif
<!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

  <!-- ************8-->
  {{--
  <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet" id="bootstrap-css"> --}}

  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}"/>
  <!-- ************8-->

  <!-- ************8-->
  <!-- icon -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
        crossorigin="anonymous">


  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>

  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
  <!-- new -->
</head>
<body>


    <div class="text-primary bg-white title-admin-info"><img
          class=" avatar1"
          src="{{ url('/') }}/imgs/@if(Auth::user()->avatar){{Auth::user()->avatar}}@elseif(!Auth::user()->avatar && Auth::user()->gender==1){{"avatar_male.jpg"}}@else{{"avatar_female.jpg"}}@endif">{{Auth::user()->name}}
    </div>
    <div class="text-primary title-admin "><i class="fas fa-exclamation-triangle"></i>&nbsp;Báo cáo</div>
    <div class="text-primary title-admin"><i class="fas fa-users"></i>&nbsp;Thành viên</div>
    <div class="text-primary title-admin"><i class="fas fa-times"></i>&nbsp;Thành viên bị khoá</div>
    <div class="text-primary title-admin"><i class="fas fa-address-card"></i>&nbsp;Các quản trị viên</div>



</body>
</html>