@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
      <div class="card-body">
        @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
        @endif
        <div class="row">
          @foreach ($users as $user)
            <div class="col-md-4" id="myTable">
              <div class="box box-primary" style="margin-top:15px;">
                <div class="box-body box-profile">
                  <div class="rounded mx-auto d-block"><img class=" rounded mx-auto d-block avatar"
                                                            src="{{ url('/') }}/imgs/@if($user->avatar){{$user->avatar}}@elseif(!$user->avatar && $user->gender==1){{"avatar_male.jpg"}}@else{{"avatar_female.jpg"}}@endif"
                                                            alt="User profile picture"></div>
                  <h3 class="profile-username text-center"><a href="\profile_friend\{{$user->id}}">{{$user->name}}</a>
                  </h3>
                  <p class="text-muted text-center">{{$user->email}}</p>
                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Followers</b> <a class="pull-right">1,322</a>
                    </li>
                    <li class="list-group-item">
                      <b>Following</b> <a class="pull-right">543</a>
                    </li>
                    <li class="list-group-item">
                      <b>Friends</b> <a class="pull-right">13,287</a>
                    </li>
                  </ul>
                  @if($user['check']=='no')
                    <div class="awrapper">
                      <button user_id="{{Auth::id()}}" friend_id="{{$user->id}}"
                              class="btn btn-primary btn-block no_friend">Gửi
                        lời
                        mời
                        kết bạn
                      </button>
                    </div>

                  @else
                    <div class="div-wrapper">
                      <div class="dropdown profilePeople">
                        <button class="
                                                @if($user['check']=='friend')
                            btn btn-success
@elseif($user['check']=='sended')
                            btn btn btn-danger
@elseif($user['check']=='request')
                            btn btn-danger
@endif
                            dropdown-toggle profilePeople" type="button"
                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                          @if($user['check']=='friend')
                            <i class="fas fa-user-friends"></i>Bạn bè
                          @elseif($user['check']=='sended')
                            <i class="fas fa-arrow-left"></i>Bạn đã gửi lời mời kết bạn
                          @elseif($user['check']=='request')
                            <i class="fas fa-arrow-left"></i>Đang chờ bạn xác nhận
                          @endif
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          @if($user['check']=='friend')
                            <a class="dropdown-item" href="\profile_friend\{{$user->id}}">Xem trang cá nhân</a>
                            <a class="dropdown-item refuse" user_id="{{Auth::id()}}" friend_id="{{$user->id}}"
                               href="javascript:void(0)">Hủy kết bạn</a>
                          @elseif($user['check']=='sended')
                            <a class="dropdown-item refuse"
                               user_id="{{Auth::id()}}" friend_id="{{$user->id}}" href="javascript:void(0)">Xóa</a>
                            {{--//\refuse\{{$user->id}}\{{$user1[0]->id}}"--}}
                          @elseif($user['check']=='request')
                            <a class="dropdown-item accept"
                               user_id="{{Auth::id()}}" friend_id="{{$user->id}}"
                               href="\accept\{{$user->id}}\{{$user1[0]->id}}">Chấp
                              nhận lời mời</a>
                            <a class="dropdown-item refuse"
                               user_id="{{Auth::id()}}" friend_id="{{$user->id}}"
                               href="\refuse\{{$user->id}}\{{$user1[0]->id}}">Xóa</a>

                          @endif

                        </div>
                      </div>
                    </div>
                  @endif
                  {{--<div>{{$check}}</div>--}}
                  {{--<div>{{$user->id}}</div>--}}
                </div>
                <!-- /.box-body -->

              </div>
            </div>
          @endforeach
          {{--<div><h1>{{$user1[0]->id}}</h1></div>--}}

        </div>
      </div>
    </div>
  </div>
  <script>
		$(document).ready(function () {
			$('div .row').on('click', '.no_friend', function (e) {
				e.preventDefault();
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
					}
				});
				var this_a = $(this);
				var friend_id = this_a.attr('friend_id');
				var user_id = this_a.attr('user_id');
				var this_a_wrapper = this_a.parent();
				var url = '/send_rq_test/' + friend_id;
				this_a.remove();
				var change = "<div class=\"dropdown profilePeople\">\n" +
						"                      <button class=\"\n" +
						"                                                                          btn btn btn-danger\n" +
						"                          dropdown-toggle profilePeople\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
						"                                                  <i class=\"fas fa-arrow-left\"></i>Bạn đã gửi lời mời kết bạn\n" +
						"                                              </button>\n" +
						"                      <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">\n" +
						"                                                  <a class=\"dropdown-item refuse\" user_id=\"" + user_id + "\" friend_id=\"" + friend_id + "\" href=\"javascript:void(0)\">Xóa</a>\n" +
						"\t\t\t\t\t\t\t\t\t\t\t\t\t\n" +
						"                        \n" +
						"                      </div>\n" +
						"\t\t\t\t\t\t\t\t\t\t</div>";
				$.ajax
				({
					url: url,
					method: "POST",
					dataType: "json",
					data: {
						user_id: user_id,
						friend_id: friend_id
					},
					success: function (res) {
						console.log(res);
						this_a_wrapper.append(change);
					}
				});
				return false;
			});
			$('div .row').on('click', '.refuse', function (e) {
				e.preventDefault();
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
					}
				});
				var this_a = $(this);
				var friend_id = this_a.attr('friend_id');
				var user_id = this_a.attr('user_id');
				var this_a_wrapper = this_a.parent().parent();
				var url = '/refuse_test/';
				var this_a_wrapper2 = this_a_wrapper.parent();
				var change = "<button user_id=\"" + user_id + "\" friend_id=\"" + friend_id + "\" class=\"btn btn-primary btn-block no_friend\">Gửi\n" +
						"                        lời\n" +
						"                        mời\n" +
						"                        kết bạn</button>";
				this_a_wrapper.remove();
				$.ajax
				({
					url: url,
					method: "POST",
					dataType: "json",
					data: {
						user_id: user_id,
						friend_id: friend_id
					},
					success: function (res) {
						console.log(res);
						this_a_wrapper2.append(change);
					}
				});
				return false;
			});
			$('div .row').on('click', '.accept', function (e) {
				e.preventDefault();
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
					}
				});
				var this_a = $(this);
				var friend_id = this_a.attr('friend_id');
				var user_id = this_a.attr('user_id');
				var this_a_wrapper = this_a.parent().parent();
				var url = '/accept_ajax/';
				var this_a_wrapper2 = this_a_wrapper.parent();

				var change = "<div class=\"dropdown profilePeople\">\n" +
						"                      <button class=\"\n" +
						"                                                                          btn btn-success\n" +
						"                          dropdown-toggle profilePeople\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">\n" +
						"                                                  <i class=\"fas fa-user-friends\"></i>Bạn bè\n" +
						"                                              </button>\n" +
						"                      <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">\n" +
						"                                                  <a class=\"dropdown-item\" href=\"\\profile_friend\\"+friend_id+"\">Xem trang cá nhân</a>\n" +
						"                          <a class=\"dropdown-item refuse\" user_id=\""+user_id+"\" friend_id=\""+friend_id+"\" href=\"javascript:void(0)\">Hủy kết bạn</a>\n" +
						"                        \n" +
						"                      </div>\n" +
						"\t\t\t\t\t\t\t\t\t\t</div>";
				this_a_wrapper.remove();
				$.ajax
				({
					url: url,
					method: "POST",
					dataType: "json",
					data: {
						user_id: user_id,
						friend_id: friend_id
					},
					success: function (res) {
						console.log(res);
						this_a_wrapper2.append(change);
					}
				});
				return false;
			});
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
