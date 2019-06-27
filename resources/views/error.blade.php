@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="card-body container">
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif
      <div class="container">
        <div class="card-body">
          <div class="text-center text-primary name"><h1>{{$msg}}</h1></div>
          <div class="text-center text-white"><a class="btn btn-primary " href="/home">Trở về trang chủ</a>
            <div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
		$(document).ready(function () {
			$('#myInput').on('keyup', function (event) {
				event.preventDefault();
				/* Act on the event */
				var tukhoa = $(this).val().toLowerCase();
				$('#myTable > div').filter(function () {
					$(this).toggle($(this).text().toLowerCase().indexOf(tukhoa) > -1);
				});
			});
		});
  </script>

@endsection
