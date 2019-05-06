@extends('layouts.app')
@section('content')
    <div class="container">


        <div class="row justify-content-center">


            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-4">
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <div class="rounded mx-auto d-block"><img class=" rounded mx-auto d-block avatar"
                                                                          src="{{ url('/') }}/imgs/{{$user1->avatar}}"
                                                                          alt="User profile picture"></div>
                                <h3 class="profile-username text-center">{{$user1->name}}</h3>

                                <p class="text-muted text-center">Quản trị viên</p>

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

                                <a href="\profile_post\{{$user1->id}}" class="btn btn-primary btn-block"><b>Trang cá
                                        nhân</b></a>
                            </div>
                            <!-- /.box-body -->
                        </div>

                    </div>
                    @foreach ($user as $key)
                        <div class="col-md-4">
                            <div class="box box-primary">
                                <div class="box-body box-profile">
                                    <div class="rounded mx-auto d-block"><img class=" rounded mx-auto d-block avatar"
                                                                              src="{{ url('/') }}/imgs/{{$key->avatar}}"
                                                                              alt="User profile picture"></div>
                                    <h3 class="profile-username text-center">{{$key->name}}</h3>

                                    <p class="text-muted text-center">{{$key->email}}</p>

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

                                    <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>


    </div>
@endsection
