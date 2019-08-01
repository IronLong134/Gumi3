
@extends('admin-view.admin-view-master')
<link href="{{ asset('css/admin-login.css') }}" rel="stylesheet">

{{--@extends('demo')--}}
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="">
      <img src="{{url('imgs/ironman_icon.png')}}" id="icon" alt="User Icon" />
    </div>
    <div id="error_wrapper">
      @if($errors->has('errorlogin'))
        <div class="alert alert-danger">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          {{$errors->first('errorlogin')}}
        </div>

      @endif
    </div>

    <!-- Login Form -->
    <form id='admin-login' action="{{url('admin\postLogin')}}" method="POST">
      {{ csrf_field ()}}
      <input type="email" id="email" class="fadeIn second" name="email" placeholder="email" autofocus>
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="#">Forgot Password?</a>
    </div>
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  </div>

  </div>
<script src="{{ asset('js/admin-login.js') }}" defer></script>



