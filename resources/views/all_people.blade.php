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

                    @foreach ($users as $user)
                        <div class="col-md-4" id="myTable">
                            <div class="box box-primary" style="margin-top:15px;">
                                <div class="box-body box-profile">
                                    <div class="rounded mx-auto d-block"><img class=" rounded mx-auto d-block avatar"
                                                                              src="{{ url('/') }}/imgs/{{$user->avatar}}"
                                                                              alt="User profile picture"></div>
                                    <h3 class="profile-username text-center">{{$user->name}}</h3>

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
                                    <?php
                                    $check = 'no';

                                    foreach ($user1[0]->friends as $value) {
                                        if ($value->receive_id == $user->id && $value->accept == 1 && $value->delete_at==0) {
                                            $check = 'friend';

                                        } else if ($value->receive_id == $user->id && $value->accept == 0&& $value->delete_at==0) {
                                            $check = 'sended';
                                        }


                                    }
                                    foreach ($user->friends as $friend) {
                                        if ($friend->receive_id == $user1[0]->id && $friend->accept == 0 && $friend->delete_at==0) {
                                            $check = 'request';
                                        } else if ($friend->receive_id == $user1[0]->id && $friend->accept == 1 && $friend->delete_at==0) {
                                            $check = 'friend';
                                        }

                                    }


                                    ?>

                                    @if($check == 'friend')

                                        <div class="btn btn-success btn-block"><b><i class="fas fa-user-friends"></i>Bạn
                                                bè</b></div>

                                    @elseif($check == 'sended')


                                        <div class="btn btn-danger btn-block"><b><i class="fas fa-arrow-right"></i>Bạn
                                                đã
                                                gửi lời mời</b></div>

                                    @elseif($check == 'request' )


                                        <a href="\accept\{{$user->id}}\{{$user1[0]->id}}"
                                           class="btn btn-danger btn-block"><b><i
                                                    class="fas fa-arrow-left"></i>Đang chờ bạn chấp nhận</b></a>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary">
                                                Social</button>
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span><span class="sr-only">Social</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Twitter</a></li>
                                                <li><a href="https://plus.google.com/+Jquery2dotnet/posts">Google +</a></li>
                                                <li><a href="https://www.facebook.com/jquery2dotnet">Facebook</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">Github</a></li>
                                            </ul>
                                        </div>

                                    @elseif($check == 'no')

                                        <a href="\send_rq\{{$user->id}}" class="btn btn-primary btn-block"><b>Gửi lời
                                                mời
                                                kết bạn</b></a>

                                    @endif
                                    <div>{{$check}}</div>
                                    <div>{{$user->id}}</div>
                                </div>
                                <!-- /.box-body -->

                            </div>
                        </div>
                    @endforeach
                    <div><h1>{{$user1[0]->id}}</h1></div>

                </div>
            </div>
        </div>


    </div>
    <script>
        $(document).ready(function() {
            $('#myInput').on('keyup', function(event) {
                event.preventDefault();
                /* Act on the event */
                var tukhoa = $(this).val().toLowerCase();
                $('#myTable > div').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(tukhoa)>-1);
                });
            });
        });
    </script>
@endsection
