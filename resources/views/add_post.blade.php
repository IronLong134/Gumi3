@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="card-body">
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif
      <div class='row'>
        <div class="col-md-4 card ">
          <div class="box box-primary">
            <div class="box-body box-profile bg-primary">
              <div class="imgWrapper1"><img class="avatar"
                                            src="{{ url('/') }}/imgs/@if($user->avatar){{$user->avatar}}@elseif(!$user->avatar && $user->gender==1){{"avatar_male.jpg"}}@else{{"avatar_female.jpg"}}@endif"
                                            alt="User profile picture"></div>
              <h3 class="profile-username text-center text-white name1">{{$user->name}}</h3>
              <h4 class="text-center text-white">@if($user->nick_name)({{$user->nick_name}})@endif</h4>
              <p class="text-center text-white intro">{{$user->intro}}</p>
              <ul class="list-group list-group-unbordered">
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-venus-mars"></i><b>giới tính</b></div>
                    <div class="contentInfo"><a class="pull-right">@if($user->gender==1)Nam @elseif($user->gender==0)
                          Nữ @endif</a></div>
                  </div>
                </li>
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-phone"></i><b> Số điện thoại</b></div>
                    <div class="contentInfo"><a class="pull-right">{{$user->mobile}}</a></div>
                  </div>
                </li>
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-mail-bulk"></i><b>Gmail</b></div>
                    <div class="contentInfo"><a class="pull-right">{{$user->email}}</a></div>
                  </div>
                </li>
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-birthday-cake"></i><b> Sinh nhật</b></div>
                    <div class="contentInfo"><a class="pull-right">{{$user->birthday}}</a></div>
                  </div>
                </li>
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-id-card-alt"></i><b> Chứng minh </b></div>
                    <div class="contentInfo"><a class="pull-right">{{$user->personal_id}}</a></div>
                  </div>
                </li>
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-briefcase"></i><b> Công việc </b></div>
                    <div class="contentInfo"><a class="pull-right">{{$user->job}}</a></div>
                  </div>
                </li>
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-futbol"></i><b> Sở thích </b></div>
                    <div class="contentInfo"><a
                          class="pull-right">{{$user->favorite_1}}&emsp;{{$user->favorite_2}}&emsp;{{$user->favarite_3}}</a>
                    </div>
                  </div>

                </li>
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-graduation-cap"></i><b> Tốt nghiệp</b></div>
                    <div class="contentInfo"><a class="pull-right">{{$user->graduate_year}}</a></div>
                  </div>
                </li>
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-school"></i><b> Đã học tại</b></div>
                    <div class="contentInfo"><a class="pull-right">{{$user->university}}</a></div>
                  </div>
                </li>
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-school"></i><b> Đã học tại</b></div>
                    <div class="contentInfo"><a class="pull-right">{{$user->high_school}}</a></div>
                  </div>
                </li>

                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-tint"></i><b> Nhóm máu</b></div>
                    <div class="contentInfo"><a class="pull-right">{{$user->blood_name}}</a></div>
                  </div>
                </li>
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-sign-in-alt"></i><b> Tham gia từ</b></div>
                    <div class="contentInfo"><a>{{$user->created_at}}</a></div>
                  </div>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <a class="btn btn-primary" href="/edit_profile/{{$user->id}}"><i class="fas fa-newspaper"></i>Cập nhật thông
            tin</a><br> @if($user->style=="admin")
            <a class="btn btn-primary" href="/admin"><i class="fas fa-address-book"></i>Quản trị thành viên</a>
            <br> @endif
          <a class="btn btn-primary" href="/list_block/{{$user->id}}"><i class="fas fa-user-lock"></i>Danh sách chặn</a><br>
          <label></label>

        </div>
        <div class="col-md-8 card">
          <form action="/add_post/{{$user_id}}" method="POST" style="margin-top:16px;">
            {{csrf_field()}}
            <div class="form-group">

              <input type="hidden" name="user_id" id="user_id" value="{{$user_id}}">
              <textarea class="form-control" rows="5" id="content" name="content"
                        placeholder="Bạn đang nghĩ gì? ngày hôm nay của bạn thế nào ?"></textarea>
              <button style="margin-top:5px;" type="submit" class="btn btn-default btn-primary"><i
                    class="far fa-grin-wink"></i>Đăng
              </button>
            </div>
          </form>
          @foreach ($datas as $data)
            <div class=" border row mypost">
              <div class="col-md-12">
                <div class="user-block">
                  <img class=" avatar1" src="{{ url('/') }}/imgs/{{$data->user->avatar}}"
                       alt="">
                  <span class="username">
                                        <a class="name" href="#">{{$data->user->name}}</a>
                                    </span>
                  <div class="description">Shared publicly - {{$data->user->created_at}}</div>
                </div>
                <p>
                  {{$data->content}}
                </p>
                <div class="cmt_like border">
                  <a class="tag_like non-textdecoration like_btn @if($data->checkLike!='liked')text-muted @else text-primary @endif" href="javascript:void(0)" user_id="{{Auth::id()}}" post_id="{{$data->id}}"><i class="fas fa-thumbs-up"></i>Like(
                    <like>{{count($data->like)}}</like>
                    )</a>
                  <a class="non-textdecoration tag_like text-muted" href="javascript:void(0)"><i
                        class="fas fa-comment"></i>Comment(
                    <comment>{{count($data->comment)}}</comment>
                    )
                  </a>
                  <a class="non-textdecoration tag_like text-muted"
                     href="/post/{{$data->id}}"><i class="fas fa-chevron-circle-down"></i>xem thêm</a>
                </div>

              </div>
              {{--<div class="col-md-2 text-primary" style="padding-left:60px;">--}}
                {{--<i class="fas fa-trash-alt"></i><span><a href="/delete/{{$data->id}}">xóa</a></span>--}}
              {{--</div>--}}
            </div>

          @endforeach
        </div>
      </div>

    </div>
  </div>
  <script src="{{ asset('js/my-profile.js') }}" defer></script>
@endsection
