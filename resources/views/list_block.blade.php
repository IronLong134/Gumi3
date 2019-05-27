@extends('layouts.app')
@section('content')
  <div class="container">

    <div class="card-body container">
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif
      @foreach($blocks as $block)
        <div id="myTable">
          <div class="card request">
            <div class="row user-block">
              <div class="col-md-3" style="text-align:right; ">
                <img class=" avatar1" src="{{ url('/') }}/imgs/@if($block->receive->avatar){{$block->receive->avatar}}@elseif(!$block->receive->avatar && $user->gender==1){{"avatar_male.jpg"}}@else{{"avatar_female.jpg"}}@endif"
                     alt="">
              </div>
              <div class="col-md-5">
                <div class="row">
                  <div class="name1 text-primary"
                    >{{$block->receive->name}}</div>

                </div>
              </div>
              <div class="col-md-2">
                <a class="btn btn-primary" href="\delete_block\{{$user->id}}\{{$block->receive_id}}">Bỏ chặn</a>
              </div>
            </div>
          </div>
        </div>
      @endforeach


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
