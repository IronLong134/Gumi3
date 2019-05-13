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
                <div class="text-center text-primary name">Danh sách bạn bè</div>
                <div class="row" id="myTable">

                    @foreach($friends as $friend)

                        <div class="col-md-6 card"  >

                            <div class="inline">
                                <div class="dropdown profileWrapper" >
                                    <img class="avatar1" src="{{ url('/') }}/imgs/{{$friend['friend']->avatar}}">
                                    <span class="profileName"><a class="name inline" href="\profile_friend\{{$friend['friend']->id}}" style="font-size:x-large;">{{$friend['friend']->name}}</a></span>
                                    <button class="btn btn-success dropdown-toggle right" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Bạn bè
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="\profile_friend\{{$friend['friend']->id}}">Xem trang cá nhân</a>
                                            <a class="dropdown-item"
                                               href="\refuse\{{$friend['friend']->id}}\{{Auth::user()->id}}">Hủy kết bạn</a>
                                    </div>
                                </div>
                            </div>
                            <div class="description">Đã là bạn bè từ&ensp; {{$friend->updated_at}}</div>

                        </div>
                    @endforeach
                </div>

            </div>
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
