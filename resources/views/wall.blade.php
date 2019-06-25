@extends('layouts.app')
@section('content')

  <body class="hold-transition skin-blue sidebar-mini" style="font-family:Arial;">
  <div class="container">
    <div class="wrapper">
      <input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
      <input type="hidden" name="user_id" content="{{ Auth::user()->id}}">
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-3 profileWrapper1">
              <div class="center">
                <h2 class="name1 text-primary">
                  User Profile
                </h2>
              </div>
              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile bg-primary" style="padding-top:8px;">

                  <img class="rounded mx-auto d-block avatar"
                       src="{{ url('/') }}/imgs/@if($user->avatar){{$user->avatar}}@elseif(!$user->avatar && $user->gender==1){{"avatar_male.jpg"}}@else{{"avatar_female.jpg"}}@endif"
                       alt="User profile picture">
                  <h3 class="profile-username text-center text-white name1">{{$user->name}}</h3>

                  <p class=" text-center text-white">Software Engineer</p>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Lời mời kết bạn</b> <a class="pull-right"><div class="rq">{{count($request)}}</div></a>
                    </li>
                    <li class="list-group-item">
                      <b>Friends</b> <a class="pull-right"><div class="fri">{{count($count_friends)}}</div></a>
                    </li>
                  </ul>

                  <a href="/profile_post/{{$user->id}}" class="btn btn-primary btn-block"><b>Trang cá
                      nhân</b></a>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
              <!-- About Me Box -->
              <div class="box box-primary bg-white">
                <div class="box-header with-border center text-primary" style="margin-top:7px">
                  <h3 class="box-title name1">About Me</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body " style="margin-left:10px;">
                  <strong class="text-primary"><i class="fa fa-book margin-r-5"></i>
                    Education</strong>

                  <p class="text-muted ">
                    B.S. in Computer Science from the University of Tennessee at Knoxville
                  </p>
                  <hr>
                  <strong class="text-primary"><i class="fas fa-map-marker-alt"></i> Location</strong>
                  <p class="text-muted">Malibu, California</p>
                  <hr>
                  <strong class="text-primary"><i class="fas fa-pen-nib"></i> Skills</strong>
                  <p>
                    <span class="badge badge-primary">UI Design</span>
                    <span class="badge badge-secondary">Coding</span>
                    <span class="badge badge-success">Javascript</span>
                    <span class="badge badge-danger">PHP</span>
                    <span class="badge badge-info">Node.js</span>
                  </p>

                  <hr>

                  <strong class="text-primary"><i class="far fa-sticky-note"></i> Notes</strong>

                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim
                    neque.</p>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs" style="margin-left:21px">
                  <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
                  <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
                  <li><a href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane card postWapper" id="myTable">
                    <!-- Post -->
                    @foreach ($datas as $data)
                      <div class="post">
                        <div class="user-block">
                          <img class=" avatar1"
                               src="{{ url('/') }}/imgs/@if($data->user->avatar){{$data->user->avatar}}@elseif(!$data->user->avatar && $user->gender==1){{"avatar_male.jpg"}}@else{{"avatar_female.jpg"}}@endif"
                               alt="">
                          <span class="username">

                                                    <a class="name"
                                                       href="@if($data->user->id==Auth::id(0))\profile_post\{{$user->id}}@else\profile_friend\{{$data->user->id}}@endif">{{$data->user->name}}</a>

                                                    <a href="#" class="pull-right btn-box-tool"></a>
                                                    </span>
                          <div class="description"><i class="fas fa-globe-americas"></i>Shared
                            publicly - {{$data->created_at}}</div>
                        </div>
                        <!-- /.user-block -->
                        <p>
                          {{$data->content}}
                        </p>
                        {{-------}}
                        <div class="row">
                          <div class="col-md-1">
                            <div id="like{{$data->id}}">

                              <a id="like_btn" href="javascript:void(0)"
                                 class="@if($data->checkLike!='liked')btn btn-primary @else btn btn-danger @endif"
                                 post_id="{{$data->id}}"><i
                                    class="far fa-thumbs-up"></i> Like
                                (<b>{{count($data->like)}}</b>)</a>
                            </div>
                          </div>
                          <div class="col-md-2" style="margin-left:40px">
                            <a class="btn btn-primary text-white comment-btn"> <i
                                  class="fas fa-comments"></i>Comments(<c>{{count($data->comment)}}</c>
                              )</a>
                          </div>
                          <div class="text-primary more"><i class="fas fa-chevron-circle-down"></i><a
                                href="/post/{{$data->id}}">xem thêm</a></div>
                        </div>
                        <form class="form-horizontal form-cmt" style="margin-top:8px;"
                              action="add_comment/{{$data->id}}/{{$user->id}}"
                              method="POST">
                          {{csrf_field()}}
                          <div class="form-group margin-bottom-none">
                            <div class="row">
                              <div class="col-sm-8">
                                <input type="hidden" name="user_id"
                                       value="{{$user->id}}">
                                <input type="hidden" name="post_id"
                                       value="{{$data->id}}">
                                <input class="form-control input-sm" name="content"
                                       placeholder="type a comment">
                              </div>
                              <div class="col-sm-3">
                                <button type="submit" user_id="{{$user->id}}" post_id="{{$data->id}}"
                                        class="btn btn-danger pull-right btn-block btn-sm">
                                  Send
                                </button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
  </body>
  <script src="{{ asset('js/wall.js') }}" defer></script>
@endsection
