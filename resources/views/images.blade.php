@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card">
                <input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
                <div class="title1 bg-primary text-white text-center">CẬP NHẬT THÔNG TIN</div>
                <div class="upload_picture">
                    <div class="center"><img id="avatar" class="avatar_upload"
                                             src="{{ url('/') }}/imgs/@if($user->avatar){{$user->avatar}}@elseif(!$user->avatar && $user->gender==1){{"avatar_male.jpg"}}@else{{"avatar_female.jpg"}}@endif"
                                             alt="User profile picture"></div>
                    <div class="container">
                        <form class="form-group" action="/update_avatar" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}} {{-- Tên <br> --}}
                            <input type="hidden" id="id" name="id" value="{{$user->id}}"><br>
                            <div class="text-center text-primary"><i class="fas fa-user-tag"></i> Cập nhật ảnh đại diện
                            </div>
                            <div class="text-center"><input class="btn btn-primary" id="file" type="file"
                                                            name="select_file"
                                                            value="{{ $user->avatar}}"/></div>{{--
            <input class="btn btn-primary" type="button" onclick="enable()" name="edit" value="sửa thông tin"><br> --}}
                            <div class="text-center"><input class="btn btn-primary"
                                                            onclick="return confirm('xác nhận thông tin sửa');"
                                                            type="submit" id="ok" name="ok"
                                                            value="Thêm ảnh"><br>
                            </div>
                        </form>
                    </div>
                    <div class="container text-center">
                        <div class="row">
                            @if($images)
                                @foreach($images as $key=>$image)
                                    <div class="col-md-3" id="{{$key}}">
                                        <img class="avatar_upload list-img" data="{{$image}}"
                                             src="{{ url('/') }}/imgs/{{$image}}"
                                             alt="User profile picture">
                                        <div>
                                            <button class="btn btn-primary">Xóa ảnh</button>
                                            <button class="btn btn-success btn-avatar">cập nhật làm ảnh đại diện</button>
                                        </div>
                                    </div>

                                @endforeach
                            @endif
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('content')
                }
            });
            $('div .row').on('click', '.btn-primary', function (e) {
                e.preventDefault();
                $(this).parent().parent().remove();

                var listImg = $('.list-img');
                var newListImg = '';

                listImg.each(function (idx, val) {
                    newListImg += $(val).attr('data') + ' ';
                });

                newListImg.substr(newListImg.length - 1, newListImg.length);

                var url = '/deleteImage';
                $.ajax
                ({
                    url: url,
                    method: "POST",
                    dataType: "json",
                    data: {
                        images: newListImg
                    },
                    success: function (res) {
                        console.log(res);
                    }
                });
                return false;

            })
            $('div .row').on('click', '.btn-avatar', function (e) {
                e.preventDefault();
               // $(this).parent().parent().remove();

                var listImg = $(this).parent().parent().find('img');
                var image= listImg.attr('data');
                $('#avatar').attr('src',"http://localhost:8000/imgs/"+ image);
                // var newListImg = '';
                //
                // listImg.each(function (idx, val) {
                //     newListImg += $(val).attr('data') + ' ';
                // });

                //newListImg.substr(newListImg.length - 1, newListImg.length);

                var url = '/updateAvatar';
                $.ajax
                ({
                    url: url,
                    method: "POST",
                    dataType: "json",
                    data: {
                        image: image
                    },
                    success: function () {

                    }
                });
                return false;
            })
        });
    </script>
@endsection
