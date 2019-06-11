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
        <div class="text-center text-primary name">Tin nhắn</div>
        <div class="row" id="myTable">
					<div class="col-md-6 card text-center">
            <div class="text-center text-primary name">Chưa đọc </div>
            @foreach($No_reads as $No_read)
              <div class="card"  >
                <div class="padding-2">
                  <div class="inline">
                    <div class="dropdown profileWrapper" >

                      <img class="avatar1" src="{{ url('/') }}/imgs/@if($No_read->avatar){{$No_read->avatar}}@elseif(!$No_read->avatar &&$No_read->gender==1){{"avatar_male.jpg"}}@else{{"avatar_female.jpg"}}@endif">
                      <span class="profileName"><a class="name inline" href="\chat_friend\{{$No_read->id}}" style="font-size:x-large;">{{$No_read->name}}</a></span>  <span class="badge badge-danger">{{$No_read->count}}</span>
                      <button class="btn btn-danger dropdown-toggle right" type="button"
                              id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false">
                        {{$No_read->count}}
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="\profile_friend\{{$No_read->id}}">Xem trang cá nhân</a>
                        <a class="dropdown-item" href="\chat_friend\{{$No_read->id}}">Trò chuyện</a>


                      </div>
                    </div>
                  </div>
                  <div class="description">{{$No_read->last_msg[0]->content}}&ensp; </div>
                </div>
              </div>
            @endforeach
          </div>
					<div class="col-md-6 card text-center">
            <div class="text-center text-primary name">Tin nhắn khác</div>
            @foreach($Readeds as $Readed)
              <div class="card"  >
                <div class="padding-2">
                  <div class="inline">
                    <div class="dropdown profileWrapper" >

                      <img class="avatar1" src="{{ url('/') }}/imgs/@if($Readed->avatar){{$Readed->avatar}}@elseif(!$Readed->avatar &&$Readed->gender==1){{"avatar_male.jpg"}}@else{{"avatar_female.jpg"}}@endif">
                      <span class="profileName"><a class="name inline" href="\chat_friend\{{$Readed->id}}" style="font-size:x-large;">{{$Readed->name}}<msg class="abc"></msg></a></span>
                      <button class="btn btn-success dropdown-toggle right" type="button"
                              id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false">
                        Tuỳ chọn
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="\profile_friend\{{$Readed->id}}">Xem trang cá nhân</a>
                        <a class="dropdown-item" href="\chat_friend\{{$Readed->id}}">Trò chuyện</a>
                        <a class="dropdown-item" name="unfriend" user_id="" friend_id="">Hủy kết bạn</a>

                      </div>
                    </div>
                  </div>
                  <div class="description"></div>
                  <div class="description">{{$Readed->last_msg[0]->content}}&ensp; </div>
                </div>
              </div>
            @endforeach
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
