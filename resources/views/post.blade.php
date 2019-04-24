@extends('layouts.app') 
@section('content')
<div class="container">

  <section class="content-header">


    <div>

      <nav class="navbar navbar-expand-lg navbar-light bg-primary ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03"
          aria-expanded="false" aria-label="Toggle navigation">
                                      <span class="navbar-toggler-icon"></span>
                                    </button>
        <a class="navbar-brand text-white" href="\home"><i class="far fa-newspaper"></i> Bảng tin
                  </a>


        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="navbar-brand text-white" href="/profile_post/{{$user->id}}"><i class="fas fa-user"></i> {{$user->name}} <span class="sr-only">(current)</span></a>
            </li>
            {{--
            <li class="nav-item">
              <a class="nav-link text-white" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled text-white" href="#">Disabled</a>
            </li> --}}
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-info my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
    </div>

  </section>

  <div class="card-body">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
    @endif
    <div class='row'>
      <div class="col-md-4 card">
        <div class="box box-primary">
          <div class="box-body box-profile" style="margin-top:7px;">
            <img class="rounded mx-auto d-block avatar" src="{{ url('/') }}/imgs/{{$post[0]->user->avatar}}" alt="User profile picture">
            <h3 class="profile-username text-center name1 text-primary">{{$post[0]->user->name}}</h3>

            <p class="text-muted text-center">Software Engineer</p>

            <ul class="list-group list-group-unbordered">
              <li class="list-group-item center">
                <b>Followers</b> <a class="pull-right">1,322</a>
              </li>
              <li class="list-group-item center">
                <b>Following</b> <a class="text-right">543</a>
              </li>
              <li class="list-group-item center">
                <b>Friends</b> <a class="text-right">13,287</a>
              </li>
            </ul>


          </div>
          <!-- /.box-body -->
        </div>


        <a class="btn btn-primary" href="/home">Trang chủ</a><br>
        <label></label>
        <a class="btn btn-primary" href="/profile_post/{{$user->id}}">Trang cá nhân của tôi</a><br>
        <label></label>

      </div>
      <div class="col-md-8 card">

        <div class="user-block">
          <div class="inline"><img class=" avatar1" src="{{ url('/') }}/imgs/{{$post[0]->user->avatar}}" alt="user image">
            <a class="name" href="#" style="font-size:x-large;">{{$post[0]->user->name}}</a>
            <div class="description">Shared publicly {{$post[0]['created_at']}}</div>
          </div>

          <div style="height:120px; padding-top:13px; margin-bottom:-13px;" class="bg-primary text-white center">{{$post[0]['content']}}</div><br>
          <div class="row" style="margin-bottom:7px;">
            <div class="col-md-1">
              <div>
                <button href="" class="btn btn-primary"><i class="far fa-thumbs-up"></i> Like({{count($post[0]->likes)}})</button>
              </div>
            </div>
            <div class="col-md-2" style="margin-left:40px">
              <button class="btn btn-primary"> <i class="fas fa-comments"></i>Comments({{count($post[0]->comments)}})</button>

            </div>

          </div>

          <script type="text/javascript">
            $(document).ready(function()
          {
              $("a.btn btn-primary").click(function()
              {
                  var id     = $(this).attr("posts-id"); //lay id video
                  var action = $(this).attr("action"); //lay hanh dong like hoac dislike
                  var data   = 'id='+ id + '&action='+ action; //du lieu gui sang server
           
                  $("#result").html('Loadding...');
           
                  //cap nhat lai so luong like, dislike
                  var count_like = $(this).find('b').text();
                  count_like = parseInt(count_like) + 1;
                  $(this).find('b').text(count_like);
           
                  $.ajax
                  ({
                      type: "POST",
                      url: "{posts_id}/addLike",
                      data: data,
                      success: function(html)
                      {
                          $("#result").html(html);
                      }
                  });
              });
          });
          </script>
          @foreach ($data as $key)
          <div class="form-inline">
            <div class="inline"><img class=" avatar1" src="{{ url('/') }}/imgs/{{$key->avatar}}" alt="user image"><a href="">{{$key->name}}</a>
              <span style="margin-left:11px;">{{$key->content}}</span>
              </span>
            </div>
          </div><br> @endforeach
          <form class="form-horizontal" style="margin-top:10px" action="add_comment/{{$posts_id}}/{{$user->id}}" method="POST">
            {{csrf_field()}}
            <div class="form-group margin-bottom-none">
              <div class="row">
                <div class="col-sm-8">
                  <input type="hidden" name="users_id" value="{{$user->id}}">
                  <input type="hidden" name="posts_id" value="{{$posts_id}}">
                  <input class="form-control input-sm" name="content" placeholder="type a comment">
                </div>
                <div class="col-sm-3">
                  <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection