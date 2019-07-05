@extends('admin-view.top-bar')
@section('report')
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
          <button report_id="" sender_id="" receiver_id=""  sender_name="" receiver_name="" id="" class="btn btn-primary btn-report">Chưa giải quyết</button>
        </td>
      </tr>
    </tbody>
  </table>
  @stop