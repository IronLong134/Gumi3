@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="container">
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif
      <div class="row text-left">
        <div class="card col-md-3 bg-white left-bar-admin">
          @include('left-bar-admin')

        </div>

        <div class="card col-md-9 bg-white left-bar-admin">
          @include('Top-bar-admin')
          <div id="admin_content" class="">
            {{--<div class="container">--}}
            {{--<div class="row text-center">--}}
            {{--<div class="bg-light col-md-4 tag-profile ">--}}
            {{--<div class="bg-info text-white tag-profile ">--}}
            {{--<div class="text-center"><img class="avatar" src="{{ url('/') }}/imgs/avatar_male.jpg"></div>--}}
            {{--<div> <a class="text-white name1" href="profile_friend/2">Tên</a> </div>--}}
            {{--<div><small>gmail</small></div>--}}
            {{--<small >tham gia từ</small>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="bg-light col-md-4 tag-profile">--}}
            {{--<div class="bg-info text-white tag-profile ">--}}
            {{--<div class="text-center"><img class="avatar" src="{{ url('/') }}/imgs/avatar_male.jpg"></div>--}}
            {{--<div> Tên </div>--}}
            {{--<div><small>gmail</small></div>--}}
            {{--<small >tham gia từ</small>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="bg-light col-md-4 tag-profile">--}}
            {{--<div class="bg-info text-white tag-profile ">--}}
            {{--<div class="text-center"><img class="avatar" src="{{ url('/') }}/imgs/avatar_male.jpg"></div>--}}
            {{--<div> Tên </div>--}}
            {{--<div><small>gmail</small></div>--}}
            {{--<small >tham gia từ</small>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--<div class="bg-light col-md-4 tag-profile">--}}
            {{--<div class="bg-info text-white tag-profile ">--}}
            {{--<div class="text-center"><img class="avatar" src="{{ url('/') }}/imgs/avatar_male.jpg"></div>--}}
            {{--<div> Tên </div>--}}
            {{--<div><small>gmail</small></div>--}}
            {{--<small >tham gia từ</small>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            <table class="table table-hover table_report">
              <thead>
              <tr>
                <th>Người báo cáo</th>
                <th>Người bị báo cáo</th>
                <th>Lí do chính</th>
                <th>Các lí do khác</th>
                <th>Thời gian</th>
                <th>Giải quyết</th>
              </tr>
              </thead>
              <tbody>
              @foreach($reports as $report)
                <tr>
                  <td><a href="admin/profile_friend/{{$report->sender_report->id}}">{{$report->sender_report->name}}</a>
                  </td>
                  <td><a
                        href="admin/profile_friend/{{$report->receiver_report->id}}">{{$report->receiver_report->name}}</a>
                  </td>
                  <td>{{$report->reason_report}}</td>
                  <td>{{$report->content}}</td>
                  <td>{{$report->updated_at}}</td>
                  <td>
                    <button report_id="{{$report->id}}" sender_id="{{$report->sender_report->id}}" receiver_id="{{$report->receiver_report->id}}"  sender_name="{{$report->sender_report->name}}" receiver_name="{{$report->receiver_report->name}}" id="" class="btn btn-primary btn-report">Chưa giải quyết</button>
                  </td>
                </tr>
                {{--<div id="modal-edit-report" class="modal container text-center fix-modal1">--}}
                  {{--<div class="modal-scrollable text-center bg-white form-report1">--}}

                    {{--Kiểm tra và khoá tài khoản--}}
                    {{--<div>Người gủi báo cáo : <a--}}
                          {{--href="admin/profile_friend/{{$report->sender_report->id}}">{{$report->sender_report->name}}</a>--}}
                    {{--</div>--}}
                    {{--<div>Người bị báo cáo : <a--}}
                          {{--href="admin/profile_friend/{{$report->receiver_report->id}}">{{$report->receiver_report->name}}</a>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                      {{--<button id="to_handle" class="btn btn-primary handle">Đánh dấu là đã giải quyết</button>--}}
                    {{--</div>--}}
                    {{--<button id="exit" class="btn btn-danger exit-btn">Thoát</button>--}}
                  {{--</div>--}}
                {{--</div>--}}
              @endforeach
              @foreach($reports_delete as $report_delete)
                <tr>
                  <td><a
                        href="admin/profile_friend/{{$report_delete->sender_report->id}}">{{$report_delete->sender_report->name}}</a>
                  </td>
                  <td><a
                        href="admin/profile_friend/{{$report_delete->receiver_report->id}}">{{$report_delete->receiver_report->name}}</a>
                  </td>
                  <td>{{$report_delete->reason_report}}</td>
                  <td>{{$report_delete->content}}</td>
                  <td>{{$report_delete->updated_at}}</td>
                  <td>
                    <button class="btn btn-danger">Đã giải quyết</button>
                  </td>
                </tr>

              @endforeach


              </tbody>
            </table>
            <div id="form-modal">

            </div>
            {{--profile--}}


          </div>
        </div>

      </div>

    </div>


  </div>
  <script src="{{ asset('js/admin-report.js') }}" defer></script>
  <script src="{{ asset('js/admin-member.js') }}" defer></script>
  <script src="{{ asset('js/list-block-acount.js') }}" defer></script>
  <script src="{{ asset('js/list-admins.js') }}" defer></script>
  <!-- Remember to include jQuery :) -->
  {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>--}}

  {{--<!-- jQuery Modal -->--}}
  {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>--}}
  {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />--}}

@endsection