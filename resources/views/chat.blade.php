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
        <input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
        <div class="text-center text-primary name">Danh sách bạn bè</div>
        <div class="row" id="myTable">
            <div class="col-md-6 card"  >

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
