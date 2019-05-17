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
                            <div class="imgWrapper1"><img class="avatar" src="{{ url('/') }}/imgs/{{$user->avatar}}"
                                                          alt="User profile picture"></div>
                            <h3 class="profile-username text-center text-white name1">{{$user->name}}</h3>
                            <h4 class="text-center text-white" >({{$user->nick_name}})</h4>
                            <p class="text-center text-white intro">intro{{$user->intro}}</p>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-phone"></i><b>  Số điện thoại</b></div>
                                        <div class="contentInfo"> <a class="pull-right">{{$user->mobile}}</a></div>
                                    </div>
                                </li>
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-mail-bulk"></i><b>Gmail</b></div>
                                        <div class="contentInfo"> <a class="pull-right">{{$user->email}}</a></div>
                                    </div>
                                </li>
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-birthday-cake"></i><b> Sinh nhật</b></div>
                                        <div class="contentInfo"> <a class="pull-right">{{$user->birthday}}</a></div>
                                    </div>
                                </li>
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-id-card-alt"></i><b> Chứng minh </b></div>
                                        <div class="contentInfo"> <a class="pull-right">{{$user->personal_id}}</a></div>
                                    </div>
                                </li>
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-briefcase"></i><b> Công việc </b></div>
                                        <div class="contentInfo"> <a class="pull-right">{{$user->job}}</a></div>
                                    </div>
                                </li>
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-futbol"></i><b> Sở thích </b></div>
                                        <div class="contentInfo"> <a class="pull-right">{{$user->favorite_1}}&emsp;{{$user->favorite_2}}&emsp;{{$user->favarite_3}}</a></div>
                                    </div>

                                </li>
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-graduation-cap"></i><b> Tốt nghiệp</b></div>
                                        <div class="contentInfo"> <a class="pull-right">{{$user->graduate_year}}</a></div>
                                    </div>
                                </li>
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-school"></i><b> Đã học tại</b></div>
                                        <div class="contentInfo"> <a class="pull-right">{{$user->university}}</a></div>
                                    </div>
                                </li>
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-school"></i><b> Đã học tại</b></div>
                                        <div class="contentInfo"> <a class="pull-right">{{$user->high_school}}</a></div>
                                    </div>
                                </li>

                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-tint"></i><b> Nhóm máu</b></div>
                                        <div class="contentInfo"> <a class="pull-right">{{$user->blood_name}}</a></div>
                                    </div>
                                </li>
                                <li class="list-group-item center">
                                    <div>
                                        <div class="icon text-primary"><i class="fas fa-sign-in-alt"></i><b> Tham gia từ</b></div>
                                        <div class="contentInfo"> <a>{{$user->created_at}}</a></div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <a class="btn btn-primary" href="/edit_profile/{{$user->id}}"><i class="fas fa-newspaper"></i>Cập nhật thông tin</a><br> @if($user->style=="admin")
                        <a class="btn btn-primary" href="/admin"><i class="fas fa-address-book"></i>Quản trị thành viên</a>
                        <br> @endif
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
                    @foreach ($data as $key)
                        <div class=" border row">
                            <div class="col-md-10">
                                <div class="user-block">
                                    <img class=" avatar1" src="{{ url('/') }}/imgs/{{$key->user->avatar}}"
                                         alt="user image">
                                    <span class="username">
                                        <a class="name" href="#">{{$key->user->name}}</a>
                                    </span>
                                    <div class="description">Shared publicly - {{$key->user->created_at}}</div>
                                </div>
                                <p>
                                    {{$key->content}}
                                </p>
                                <div class="text-primary"><i class="fas fa-chevron-circle-down"></i><a
                                        href="/post/{{$key->id}}">xem thêm</a></div>
                            </div>
                            <div class="col-md-2 text-primary" style="padding-left:60px;">
                                <i class="fas fa-trash-alt"></i><span><a href="/delete/{{$key->id}}">xóa</a></span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection
