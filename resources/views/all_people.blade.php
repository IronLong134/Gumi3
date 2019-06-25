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
	<script src="{{ asset('js/all_people.js') }}" defer></script>
@endsection
