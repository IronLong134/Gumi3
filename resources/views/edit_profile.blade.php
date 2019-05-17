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
                <div class="title1 bg-primary text-white text-center">CẬP NHẬT THÔNG TIN</div>
                <div class="upload_picture">
                    <div class="center"><img class="avatar_upload"
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
                                                            value="cập nhật ảnh đại diện"><br>
                            </div>
                        </form>
                    </div>
                    <div class="text-center margin-bottom"><a class="btn btn-primary" href="/images/{{Auth::id()}}">Chọn
                            từ ảnh của bạn</a></div>
                </div>
                <div>
                    <form method="POST" class="form" action="/update_info/{{$user->id}}">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="nickname"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Nick name') }}</label>

                            <div class="col-md-6">
                                <input id="nick_name" type="text"
                                       class="form-control"
                                       name="nick_name" value="{{ $user->nick_name }}" readonly>

                            </div>
                            <input class="btn btn-primary" type="button" id="btn-nick_name"
                                   onclick="Disable('nick_name')"
                                   name="edit" value="Thay đổi">
                        </div>
                        <div class="form-group row">
                            <label for="intro"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Mô tả bản thân') }}</label>

                            <div class="col-md-6">
                                <input id="intro" type="text"
                                       class="form-control{{ $errors->has('intro') ? ' is-invalid' : '' }}"
                                       name="intro" value="{{ $user->intro  }}" readonly>

                                @if ($errors->has('intro'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('intro') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <input class="btn btn-primary" type="button" id="btn-intro" onclick="Disable('intro')"
                                   name="edit" value="Thay đổi">
                        </div>
                        <div class="form-group row">
                            <label for="mobile"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Số điện thoại') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text"
                                       class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}"
                                       name="mobile" value="{{ $user->mobile  }}" readonly>

                                @if ($errors->has('mobile'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <input class="btn btn-primary" type="button" id="btn-mobile" onclick="Disable('mobile')"
                                   name="edit" value="Thay đổi">
                        </div>

                        <div class="form-group row">
                            <label for="birthday"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Ngày sinh') }}</label>

                            <div class="col-md-6">
                                <input id="birthday" type="date"
                                       class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}"
                                       name="birthday" value="{{$user->birthday }}" readonly>

                                @if ($errors->has('birthday'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input class="btn btn-primary" type="button" id="btn-birthday" onclick="Disable('birthday')"
                                   name="edit"
                                   value="Thay đổi"><br>
                        </div>
                        <div class="form-group row">
                            <label for="job"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Nghề nghiệp') }}</label>

                            <div class="col-md-6">
                                <input id="job" type="text"
                                       class="form-control{{ $errors->has('job') ? ' is-invalid' : '' }}"
                                       name="job" value="{{$user->job }}" readonly>

                                @if ($errors->has('job'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('job') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input class="btn btn-primary" type="button" id="btn-job" onclick="Disable('job')"
                                   name="edit"
                                   value="Thay đổi"><br>
                        </div>
                        <div class="form-group row">
                            <label for="adress"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Nơi ở ') }}</label>

                            <div class="col-md-6">
                                <input id="adress" type="text"
                                       class="form-control{{ $errors->has('adress') ? ' is-invalid' : '' }}"
                                       name="adress" value="{{$user->adress }}" readonly>

                                @if ($errors->has('adress'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('adress') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input class="btn btn-primary" type="button" id="btn-adress"
                                   onclick="Disable('adress')" name="edit"
                                   value="Thay đổi"><br>
                        </div>
                        <div class="form-group row">
                            <label for="favorite_1"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Sở thích 1') }}</label>

                            <div class="col-md-6">
                                <input id="favorite_1" type="text"
                                       class="form-control{{ $errors->has('favorite_1') ? ' is-invalid' : '' }}"
                                       name="favorite_1" value="{{$user->favorite_1 }}" readonly>

                                @if ($errors->has('favorite_1'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('favorite_1') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input class="btn btn-primary" type="button" id="btn-favorite_1"
                                   onclick="Disable('favorite_1')" name="edit"
                                   value="Thay đổi"><br>
                        </div>
                        <div class="form-group row">
                            <label for="favorite_2"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Sở thích 2 ') }}</label>

                            <div class="col-md-6">
                                <input id="favorite_2" type="text"
                                       class="form-control{{ $errors->has('favorite_2') ? ' is-invalid' : '' }}"
                                       name="favorite_2" value="{{$user->favorite_2 }}" readonly>

                                @if ($errors->has('favorite_2'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('favorite_2') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input class="btn btn-primary" type="button" id="btn-favorite_2"
                                   onclick="Disable('favorite_2')" name="edit"
                                   value="Thay đổi"><br>
                        </div>
                        <div class="form-group row">
                            <label for="favorite_3"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Sở thích 3 ') }}</label>

                            <div class="col-md-6">
                                <input id="favorite_3" type="text"
                                       class="form-control{{ $errors->has('favorite_3') ? ' is-invalid' : '' }}"
                                       name="favorite_3" value="{{$user->favorite_3 }}" readonly>

                                @if ($errors->has('favorite_3'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('favorite_3') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input class="btn btn-primary" type="button" id="btn-favorite_3"
                                   onclick="Disable('favorite_3')" name="edit"
                                   value="Thay đổi"><br>
                        </div>
                        <div class="form-group row">
                            <label for="personal_id"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Chứng minh nhân dân') }}</label>

                            <div class="col-md-6">
                                <input id="personal_id" type="text"
                                       class="form-control{{ $errors->has('personal_id') ? ' is-invalid' : '' }}"
                                       name="personal_id" value="{{$user->personal_id }}" readonly>

                                @if ($errors->has('personal_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('personal_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input class="btn btn-primary" type="button" id="btn-personal_id"
                                   onclick="Disable('personal_id')" name="edit"
                                   value="Thay đổi"><br>
                        </div>
                        <div class="form-group row">
                            <label for="graduate"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Đã tốt nghiệp vào') }}</label>

                            <div class="col-md-6">
                                <input id="graduate" type="text"
                                       class="form-control{{ $errors->has('graduate') ? ' is-invalid' : '' }}"
                                       name="graduate_year" value="{{$user->graduate_year }}" readonly>

                                @if ($errors->has('graduate'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('graduate') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input class="btn btn-primary" type="button" id="btn-graduate" onclick="Disable('graduate')"
                                   name="edit"
                                   value="Thay đổi"><br>
                        </div>
                        <div class="form-group row">
                            <label for="university"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Trường đại học') }}</label>

                            <div class="col-md-6">
                                <input id="university" type="text"
                                       class="form-control{{ $errors->has('university') ? ' is-invalid' : '' }}"
                                       name="university" value="{{$user->university }}" readonly>

                                @if ($errors->has('university'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('university') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input class="btn btn-primary" type="button" id="btn-university"
                                   onclick="Disable('university')" name="edit"
                                   value="Thay đổi"><br>
                        </div>
                        <div class="form-group row">
                            <label for="high_school"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Trường đại học') }}</label>

                            <div class="col-md-6">
                                <input id="high_school" type="text"
                                       class="form-control{{ $errors->has('high_school') ? ' is-invalid' : '' }}"
                                       name="high_school" value="{{$user->high_school }}" readonly>

                                @if ($errors->has('high_school'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('high_school') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input class="btn btn-primary" type="button" id="btn-high_school"
                                   onclick="Disable('high_school')" name="edit"
                                   value="Thay đổi"><br>
                        </div>
                        <div class="form-group row">
                            <label for="gender"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="gender" type="text" readonly
                                        class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}"
                                        name="gender">

                                    <option @if($user->gender==1) selected='selected' @endif value='1'>Nam</option>
                                    <option @if($user->gender==0) selected='selected' @endif value='0'>Nữ</option>
                                </select>
                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <input class="btn btn-primary" type="button" id="btn-gender" onclick="Disable('gender')"
                                   name="edit"
                                   value="Thay đổi"><br>
                        </div>
                        <div class="form-group row">
                            <label for="gender"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Nhóm máu') }}</label>

                            <div class="col-md-6">
                                <select id="blood" type="text"
                                        class="form-control{{ $errors->has('blood') ? ' is-invalid' : '' }}"
                                        name="blood_type" readonly="true">


                                    @foreach($bloods as $blood)
                                        <option @if($user->blood_type==$blood->value) selected="selected"
                                                @endif value={{$blood->value}}>{{$blood->name}}</option>
                                    @endforeach
                                    <option @if($user->blood_name=="")
                                            selected="selected" @endif value="">
                                        Chưa chọn{{$user->blood_type}}
                                    </option>


                                </select>
                                <div>aaa{{$user->blood_name}}</div>

                                @if ($errors->has('blood'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('blood') }}</strong>
                                    </span>
                                @endif

                            </div>
                            <input class="btn btn-primary" type="button" id="btn-blood" onclick="Disable('blood')"
                                   name="edit"
                                   value="Thay đổi"><br>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Lưu thay đổi ') }}
                                </button>
                                <a href="/profile_post/{{Auth::id()}}" class="btn btn-primary">Trở về</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            function Disable(name) {
                var _name = $('#' + name);
                _name.attr('readonly', !_name.prop('readonly'));
                $('#btn-' + name).val(_name.prop('readonly') ? 'Thay đổi' : 'Xong');
            }
        </script>
@endsection
