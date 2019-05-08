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
                <div class="col-md-4 card">
                    <div class="box box-primary">
                        <div class="box-body box-profile bg-primary">
                            <img class="rounded mx-auto d-block avatar" src="{{ url('/') }}/imgs/{{$user->avatar}}"
                                 alt="User profile picture">
                            <h3 class="profile-username text-center text-white name1">{{$user->name}}</h3>
                            <p class="text-center text-white">Software Engineer</p>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item center"><i class="fas fa-mail-bulk"></i>
                                    <b>Gmail</b> <a class="pull-right">{{$user->email}}</a>
                                </li>
                                <li class="list-group-item center"><i class="fas fa-users"></i>
                                    <b>Tham gia từ</b> <a class="text-right">{{$user->created_at}}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <a class="btn btn-primary" href="/home"><i class="fas fa-newspaper"></i>Bảng
                        Tin</a><br> @if($user->style=="admin")
                        <a class="btn btn-primary" href="/admin"><i class="fas fa-address-book"></i>Quản trị thành viên</a>
                        <br> @endif
                    <label></label>
                    <div class="container">
                        <form class="form-group" action="/update_user" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}} {{-- Tên <br> --}}
                            <input type="hidden" id="id" name="id" value="{{$user->id}}" required><br>
                            <div class="text-center text-primary"><i class="fas fa-user-tag"></i> Cập nhật ảnh đại diện
                            </div>
                            <input class="btn btn-primary" id="file" type="file" name="select_file"
                                   value="{{ $user->avatar}}" required/> {{--
            <input class="btn btn-primary" type="button" onclick="enable()" name="edit" value="sửa thông tin"><br> --}}
                            <div style="margin:12px;" class="text-center"><input class="btn btn-primary"
                                                                                 onclick="return confirm('xác nhận thông tin sửa');"
                                                                                 type="submit" id="ok" name="ok"
                                                                                 value="cập nhật ảnh đại diện"><br>
                            </div>
                        </form>
                    </div>
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
