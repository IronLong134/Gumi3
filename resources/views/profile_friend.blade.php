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
                            <div class="imgWrapper1"><img class="avatar" src="{{ url('/') }}/imgs/{{$data[0]->avatar}}"
                                                          alt="User profile picture"></div>
                            <h3 class="profile-username text-center text-white name1">{{$data[0]->name}}</h3>
                            <p class="text-center text-white">Software Engineer</p>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item center"><i class="fas fa-mail-bulk"></i>
                                    <b>Gmail</b> <a class="pull-right">{{$data[0]->email}}</a>
                                </li>
                                <li class="list-group-item center"><i class="fas fa-users"></i>
                                    <b>Tham gia từ</b> <a class="text-right">{{$data[0]->created_at}}</a>
                                </li>
                                <li class="list-group-item center"><i class="fas fa-users"></i>
                                    <b>Đã là bạn bè của bạn từ </b> <a class="text-right">{{$relation->updated_at}}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <div>
                        <div class="dropdown profileWrapper profilePeople">
                            <button class="btn btn-success dropdown-toggle right profilePeople" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                Bạn bè
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item"
                                   href="\refuse\{{$data[0]->id}}\{{Auth::user()->id}}">Hủy kết bạn</a>
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
                                         alt="user image">
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
                </div>
            </div>

        </div>
    </div>
@endsection
