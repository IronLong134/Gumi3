@extends('admin-view.top-bar')
@section('report')
  <div class="table-wrapper">
    <table id="myTable" class="table table-hover table_report">
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

      <tr>
        <td><a href="admin/profile_friend/">abcdef</a>
        </td>
        <td><a
              href="admin/profile_friend/">cdefgh</a>
        </td>
        <td>aaaaaaaaaa</td>
        <td>ffffffffff</td>
        <td>aaaaaaaaaaaa</td>
        <td>
          <button report_id="" sender_id="" receiver_id="" sender_name="" receiver_name="" id=""
                  class="btn btn-primary btn-report">Chưa giải quyết
          </button>
        </td>
      </tr>
      @foreach( $reports as $report)
        <tr>
          <td><a href="admin/profile_friend/">{{$report->sender_report->name}}</a>
          </td>
          <td><a
                href="admin/profile_friend/">{{$report->receiver_report->name}}</a>
          </td>
          <td>{{$report->reason_report}}</td>
          <td>{{$report->content}}</td>
          <td>{{$report->updated_at}}</td>
          <td>
            <button report_id="{{$report->id}}" sender_id="{{$report->sender_id}}"
                    receiver_id="{{$report->receiver_id}}" sender_name="{{$report->sender_report->name}}"
                    receiver_name="{{$report->receiver_report->name}}" id=""
                    class="btn btn-primary btn-report">Chưa giải quyết
            </button>
          </td>
        </tr>
      @endforeach
      @foreach( $reports_delete as $report_delete)
        <tr>
          <td><a href="admin/profile_friend/{{$report_delete->sender_id}}">{{$report_delete->sender_report->name}}</a>
          </td>
          <td><a
                href="admin/profile_friend/{{$report_delete->sender_id}}">{{$report_delete->receiver_report->name}}</a>
          </td>
          <td>{{$report_delete->reason_report}}</td>
          <td>{{$report_delete->content}}</td>
          <td>{{$report_delete->updated_at}}</td>
          <td>
            <button report_id="{{$report_delete->id}}" sender_id="{{$report_delete->sender_id}}"
                    receiver_id="{{$report_delete->receiver_id}}"
                    sender_name="{{$report_delete->sender_report->name}}"
                    receiver_name="{{$report_delete->receiver_report->name}}" id=""
                    class="btn btn-dark btn-report">Đã giải quyết
            </button>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
    <div id="form-modal">

    </div>
  </div>
  <script src="{{ asset('js/admin2/report.js') }}" defer></script>
@stop