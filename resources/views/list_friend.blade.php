@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card-body container">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="container">
                <input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
                <div class="text-center text-primary name">Danh sách bạn bè</div>
                <div class="row" id="myTable">

                    @foreach($friends as $friend)

                        <div class="col-md-6 card"  >
                            <div class="padding-2">
                            <div class="inline">
                                <div class="dropdown profileWrapper" >

                                    <img class="avatar1" src="{{ url('/') }}/imgs/@if($friend['friend']->avatar){{$friend['friend']->avatar}}@elseif(!$friend['friend']->avatar &&$friend['friend']->gender==1){{"avatar_male.jpg"}}@else{{"avatar_female.jpg"}}@endif">
                                    <span class="profileName"><a class="name inline" href="\profile_friend\{{$friend['friend']->id}}" style="font-size:x-large;">{{$friend['friend']->name}}</a></span>
                                    <button class="btn btn-success dropdown-toggle right" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Bạn bè
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="\profile_friend\{{$friend['friend']->id}}">Xem trang cá nhân</a>
                                        <a class="dropdown-item" name="unfriend" user_id="{{Auth::id()}}" friend_id="{{$friend['friend']->id}}">Hủy kết bạn</a>

                                    </div>
                                </div>
                            </div>
                            <div class="description">Đã là bạn bè từ&ensp; {{$friend->updated_at}}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

    </div>
    <script>
        $(document).ready(function () {

            $("a[name='unfriend']").click(function (e) {
                e.preventDefault();
                var this_a = $(this);
                var content =this_a.parent().parent().parent().parent().parent().remove();
                var user_id=this_a.attr('user_id');
                var friend_id=this_a.attr('friend_id');
                var url ="/refuse_test";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax
                ({
                    url: url,
                    method: "POST",
                    dataType: "json",
                    data: {
                        user_id:user_id,
                        friend_id:friend_id
                    },
                    success: function (res) {
                        console.log(res);

                    }
                });
                return false;

            });

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
