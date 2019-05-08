@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="card-body container">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @foreach($friends as $friend)
                <div id="myTable">
                    <div class="card request" >
                        <div class="row user-block">
                            <div class="col-md-3" style="text-align:right; ">
                                <img class=" avatar1" src="{{ url('/') }}/imgs/{{$friend->sender->avatar}}"
                                     alt="user image">
                            </div>
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="name1 text-primary">{{$friend->sender->name}}</div>
                                    <div style="margin-left:10px">đã gửi lời mởi kết bạn</div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <a class="btn btn-primary" href="\accept\{{$friend->sender->id}}\{{$user->id}}">Chấp
                                    nhận</a>
                            </div>
                            <div class="col-md-1">
                                <a href="\refuse\{{$friend->sender->id}}\{{$user->id}}" class="btn btn-primary">Xóa</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>

    </div>
    <script>
        $(document).ready(function () {
            $('#myInput').on('keyup', function (event) {
                event.preventDefault();
                /* Act on the event */
                var tukhoa = $(this).val().toLowerCase();
                $('#myTable > div').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(tukhoa) > -1);
                });
            });
        });
    </script>
@endsection