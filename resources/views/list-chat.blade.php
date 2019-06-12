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
        <div class="container" id="myTable">
          @foreach($messengers as $messenger)
            @if($messenger->seen=="no")
              <div class="container text-center card messenger">
                <div class="padding-2">
                  <div class="inline">
                    <div class="dropdown profileWrapper">
                      <img class="avatar1"
                           src="{{ url('/') }}/imgs/@if($messenger->avatar){{$messenger->avatar}}@elseif(!$messenger->avatar &&$messenger->gender==1){{"avatar_male.jpg"}}@else{{"avatar_female.jpg"}}@endif">
                      <span class="profileName text-left"><a class="name inline" href="\chat_friend\{{$messenger->id}}"
                                                             style="font-size:x-large;">{{$messenger->name}}</a></span>
                      <button class="btn btn-success dropdown-toggle right" type="button"
                              id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false">
                        Tuỳ chọn
                      </button><div
                          class="notification text-center badge badge-danger">{{$messenger->count_no_seen}}</div>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="\profile_friend\{{$messenger->id}}">Xem trang cá nhân</a>
                        <a class="dropdown-item" href="\chat_friend\{{$messenger->id}}">Trò chuyện</a>
                      </div>
                    </div>
                  </div>
                  <div class="description text-left margin-top-15">{{$messenger->name}}:&ensp;{{$messenger->last_msg[0]->content}}&ensp;</div>
                </div>
              </div>
            @else
              <div class="container text-center card messenger">
                <div class="padding-2">
                  <div class="inline">
                    <div class="dropdown profileWrapper">
                      <img class="avatar1"
                           src="{{ url('/') }}/imgs/@if($messenger->avatar){{$messenger->avatar}}@elseif(!$messenger->avatar &&$messenger->gender==1){{"avatar_male.jpg"}}@else{{"avatar_female.jpg"}}@endif">
                      <span class="profileName text-left"><a class="name inline" href="\chat_friend\{{$messenger->id}}"
                                                             style="font-size:x-large;">{{$messenger->name}}<msg
                              class="abc"></msg></a></span>
                      <button class="btn btn-success dropdown-toggle right" type="button"
                              id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false">
                        Tuỳ chọn
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="\profile_friend\{{$messenger->id}}">Xem trang cá nhân</a>
                        <a class="dropdown-item" href="\chat_friend\{{$messenger->id}}">Trò chuyện</a>
                      </div>
                    </div>
                  </div>
                  <div class="description text-left margin-top-15">@if($messenger->last_msg['from']=='me')Tôi:
                    &ensp;@else{{$messenger->last_msg[0]->sender_msg->name}}:&ensp;
                    @endif {{$messenger->last_msg[0]->content}}&ensp;
                  </div>
                </div>
              </div>
            @endif
          @endforeach
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
  <script src="{{ asset('js/list-chat.js') }}" defer></script>

@endsection
