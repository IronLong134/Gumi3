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
              <div class="imgWrapper1">
                <img class="avatar"
                     src="{{ url('/') }}/imgs/@if($data[0]->avatar){{$data[0]->avatar}}@elseif(!$data[0]->avatar && $data[0]->gender==1){{"avatar_male.jpg"}}@else{{"avatar_female.jpg"}}@endif"
                     alt="User profile picture"></div>
              <h3 class="profile-username text-center text-white name1">{{$data[0]->name}}</h3>
              <h4 class="text-center text-white">@if($data[0]->nick_name)({{$data[0]->nick_name}}
                )@endif</h4>
              <p class="text-center text-white intro">{{$data[0]->intro}}</p>
              <ul class="list-group list-group-unbordered">
                @if($data[0]->relationship=='friend')
                  <li class="list-group-item center"><i class="fas fa-users"></i>
                    <b>Đã là bạn bè của bạn từ </b> <a
                        class="text-right">{{$data[0]->updated_at}}</a>
                  </li>
                @endif
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-venus-mars"></i><b>giới tính</b>
                    </div>
                    <div class="contentInfo"><a class="pull-right">@if($data[0]->gender==1)
                          Nam @elseif($data[0]->gender==0) Nữ @endif</a></div>
                  </div>
                </li>
                @if($data[0]->relationship=='friend')
                  <li class="list-group-item center">
                    <div>
                      <div class="icon text-primary"><i class="fas fa-phone"></i><b> Số điện
                          thoại</b></div>
                      <div class="contentInfo"><a class="pull-right">{{$data[0]->mobile}}</a>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item center">
                    <div>
                      <div class="icon text-primary"><i class="fas fa-mail-bulk"></i><b>Gmail</b>
                      </div>
                      <div class="contentInfo"><a class="pull-right">{{$data[0]->email}}</a></div>
                    </div>
                  </li>
                @endif
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-birthday-cake"></i><b> Sinh
                        nhật</b></div>
                    <div class="contentInfo"><a class="pull-right">{{$data[0]->birthday}}</a></div>
                  </div>
                </li>
                @if($data[0]->relationship=='friend')
                  <li class="list-group-item center">
                    <div>
                      <div class="icon text-primary"><i class="fas fa-id-card-alt"></i><b> Chứng
                          minh </b></div>
                      <div class="contentInfo"><a class="pull-right">{{$data[0]->personal_id}}</a>
                      </div>
                    </div>
                  </li>
                @endif
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-briefcase"></i><b> Công
                        việc </b></div>
                    <div class="contentInfo"><a class="pull-right">{{$data[0]->job}}</a></div>
                  </div>
                </li>
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-futbol"></i><b> Sở thích </b>
                    </div>
                    <div class="contentInfo"><a class="pull-right">{{$data[0]->favorite_1}}&emsp;{{$data[0]->favorite_2}}&emsp;{{$data[0]->favarite_3}}</a>
                    </div>
                  </div>

                </li>
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-graduation-cap"></i><b> Tốt
                        nghiệp</b></div>
                    <div class="contentInfo"><a class="pull-right">{{$data[0]->graduate_year}}</a>
                    </div>
                  </div>
                </li>
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-school"></i><b> Đã học tại</b>
                    </div>
                    <div class="contentInfo"><a class="pull-right">{{$data[0]->university}}</a>
                    </div>
                  </div>
                </li>
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-school"></i><b> Đã học tại</b>
                    </div>
                    <div class="contentInfo"><a class="pull-right">{{$data[0]->high_school}}</a>
                    </div>
                  </div>
                </li>
                @if($data[0]->relationship=='friend')
                  <li class="list-group-item center">
                    <div>
                      <div class="icon text-primary"><i class="fas fa-tint"></i><b> Nhóm máu</b>
                      </div>
                      <div class="contentInfo"><a class="pull-right">{{$data[0]->blood_name}}</a>
                      </div>
                    </div>
                  </li>
                @endif
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-sign-in-alt"></i><b> Tham gia
                        từ</b></div>
                    <div class="contentInfo"><a>{{$data[0]->created_at}}</a></div>
                  </div>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->

          </div>
          <div>
            {{--@if($data[0]->relationship=='no')--}}
            {{--<a href="\send_rq\{{$data[0]->id}}" class="btn btn-primary btn-block">Gửi--}}
            {{--lời--}}
            {{--mời--}}
            {{--kết bạn</a>--}}
            {{--@else--}}
            <div class="dropdown profilePeople">
              <button class="
                                                @if($data[0]->relationship=='friend')
                  btn btn-success
@elseif($data[0]->relationship=='no')
                  btn btn btn-primary
@elseif($data[0]->relationship=='sended')
                  btn btn btn-danger
@elseif($data[0]->relationship=='request')
                  btn btn-danger
@endif
                  dropdown-toggle profilePeople" type="button"
                      id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">
                @if($data[0]->relationship=='friend')
                  <i class="fas fa-user-friends"></i>Bạn bè
                @elseif($data[0]->relationship=='no')
                  <i class="fas fa-arrow-left"></i>Hãy gửi lời mời kết bạn
                @elseif($data[0]->relationship=='sended')
                  <i class="fas fa-arrow-left"></i>Bạn đã gửi lời mời kết bạn
                @elseif($data[0]->relationship=='request')
                  <i class="fas fa-arrow-left"></i>Đang chờ bạn xác nhận
                @endif
              </button>

              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @if($data[0]->relationship=='friend')
                  <a class="dropdown-item" href="\profile_friend\{{$data[0]->id}}">Xem trang cá nhân</a>
                  <a class="dropdown-item" onclick="return confirm('bạn chắc chắn muốn huỷ kết bạn người này chứ?');"
                     href="\refuse\{{Auth::id()}}\{{$data[0]->id}}">Hủy kết bạn</a>
                @elseif($data[0]->relationship=='no')
                  <a class="dropdown-item"
                     href="\send_rq\{{$data[0]->id}}">Gửi lời mời kết bạn </a>
                @elseif($data[0]->relationship=='sended')
                  <a class="dropdown-item"
                     href="\refuse\{{Auth::id()}}\{{$data[0]->id}}">Xóa</a>
                @elseif($data[0]->relationship=='request')
                  <a class="dropdown-item"
                     href="\accept\{{Auth::id()}}\{{$data[0]->id}}">Chấp
                    nhận lời mời</a>
                  <a class="dropdown-item"
                     href="\refuse\{{Auth::id()}}\{{$data[0]->id}}">Xóa</a>
                @endif
                <a class="dropdown-item" href="\chat_friend\{{$data[0]->id}}">Nhắn tin</a>
                <a class="dropdown-item" onclick="return confirm('bạn chắc chắn muốn chặn người này chứ?');"
                   href="\block\{{Auth::id()}}\{{$data[0]->id}}">Chặn người này</a>
                <a id="report" class="dropdown-item">Báo cáo </a>
              </div>

            </div>
            {{--@endif--}}

          </div>
          <div id="modal-report" class="modal">
            <div class="modal-scrollable">
              @include('report')
            </div>
          </div>
          <label></label>
        </div>
        <div class="col-md-8 card">

          @if($data[0]->relationship=='friend')
            @foreach ($data[0] ->post as $post)
              <div class=" border row">
                <div class="col-md-10 post1">
                  <div class="user-block">
                    <img class=" avatar1" src="{{ url('/') }}/imgs/{{$data[0]->avatar}}"
                         alt="">
                    <span class="username">
                                        <a class="name" href="#">{{$data[0]->name}}</a>
                                    </span>
                    <div class="description">Shared publicly - {{$post->created_at}}</div>
                  </div>
                  <p>
                    {{$post->content}}
                  </p>
                  <div class="text-primary"><i class="fas fa-chevron-circle-down"></i><a
                        href="/post/{{$post->id}}">xem thêm</a></div>
                </div>
              </div>
            @endforeach
          @endif
        </div>
      </div>

    </div>
  </div>
  <script src="{{ asset('js/report.js') }}" defer></script>
@endsection
