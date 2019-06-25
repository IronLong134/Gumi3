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
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-venus-mars"></i><b>giới tính</b>
                    </div>
                    <div class="contentInfo"><a class="pull-right">@if($data[0]->gender==1)
                          Nam @elseif($data[0]->gender==0) Nữ @endif</a></div>
                  </div>
                </li>
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
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-birthday-cake"></i><b> Sinh
                        nhật</b></div>
                    <div class="contentInfo"><a class="pull-right">{{$data[0]->birthday}}</a></div>
                  </div>
                </li>
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-id-card-alt"></i><b> Chứng
                        minh </b></div>
                    <div class="contentInfo"><a class="pull-right">{{$data[0]->personal_id}}</a>
                    </div>
                  </div>
                </li>
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
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-tint"></i><b> Nhóm máu</b>
                    </div>
                    <div class="contentInfo"><a class="pull-right">{{$data[0]->blood_name}}</a>
                    </div>
                  </div>
                </li>
                <li class="list-group-item center">
                  <div>
                    <div class="icon text-primary"><i class="fas fa-sign-in-alt"></i><b> Tham gia
                        từ</b></div>
                    <div class="contentInfo"><a>{{$data[0]->created_at}}</a></div>
                  </div>
                </li>
              </ul>
            </div>

          </div>
          <div id="wraper_block1">
            <div id="block-msg-wrapper"> @if($data[0]->block==1)
                <div class="bg-danger text-white text-center block-msg">Tài khoản này đã bị khoá</div>
              @endif
            </div>
            <div class="dropdown profilePeople">
              <button class="btn btn-danger

                  dropdown-toggle profilePeople" type="button"
                      id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">
                @if($data[0]->id==Auth::id())
                  Đây là tài khoản của bạn
                @else
                  Tuỳ chọn
                @endif
              </button>

              <div class="dropdown-menu block-dropdown" aria-labelledby="dropdownMenuButton">
                @if($data[0]->id==Auth::id())
                  <a id="profile_admin" class="dropdown-item" href="\profile_post\{{$data[0]->id}}">Mở trang cá nhân của
                    bạn</a>
                @else
                  @if($data[0]->block==0)
                    <a user_id="{{$data[0]->id}}" id="block_user" class="dropdown-item"
                       href="\chat_friend\{{$data[0]->id}}">Khoá tài khoản này </a>
                  @else
                    <a id="unblock_user" class="dropdown-item" href="\chat_friend\{{$data[0]->id}}">Mở khoá tài khoản
                      này </a>
                  @endif
                @endif
                <input type="hidden" id="data" user_id="{{$data[0]->id}}" name="data" >
              </div>
            </div>
          </div>
          <label></label>
        </div>
        <div class="col-md-8 card">


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
                {{--<div class="text-primary"><i class="fas fa-chevron-circle-down"></i><a--}}
                {{--href="/post/{{$post->id}}">xem thêm</a></div>--}}
              </div>
            </div>
          @endforeach
        </div>
      </div>

    </div>
  </div>
  <script src="{{ asset('js/report.js') }}" defer></script>
  <script src="{{asset('js/admin_profile_user.js') }}" defer></script>
@endsection
