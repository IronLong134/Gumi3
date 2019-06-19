@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="container">
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif
      <div class="row text-left">
        <div class="card col-md-3 bg-white left-bar-admin">
          @include('left-bar-admin')

        </div>

        <div class="card col-md-9 bg-white">abc</div>
      </div>
    </div>
  </div>
@endsection