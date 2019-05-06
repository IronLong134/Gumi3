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
                        <?php
                        $avatar = 'null';
                        $name = 'null';
                        $updated_at = 'null';
                        if ($friend->sender_id == Auth::user()->id) {

                            $avatar = $friend->receive->avatar;
                            $name = $friend->receive->name;
                            $updated_at = $friend->receive->updated_at;
                        } else if ($friend->receive_id == Auth::user()->id) {
                            $avatar = $friend->sender->avatar;
                            $name = $friend->sender->name;
                            $updated_at = $friend->sender->updated_at;
                        }
                        ?>

                        <div class="col-md-6 card" >

                            <div class="inline"><img class="avatar1" src="{{ url('/') }}/imgs/{{$avatar}}">
                            <span><a class="name inline" href="#" style="font-size:x-large;">{{$name}}</a></span></div>
                            <div class="description">Đã là bạn bè từ&ensp; {{$updated_at}}</div>
                        </div>





                    @endforeach
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
