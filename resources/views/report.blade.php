<div class="container bg-white report-form fix-modal">
<form>
  <div class="form-group">
    <input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
    <label for="exampleInputEmail1">Lí do báo cáo</label>
    <small id="emailHelp" class="form-text text-muted">Chọn lí do có sẵn bên dưới vì sao bạn muốn báo cáo người này </small>
    <select type="email" class="form-control" id="reason">
      @foreach($reports as $report)
        <option value="{{$report->value}}">{{$report->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Lí do khác</label>
    <small id="emailHelp" class="form-text text-muted">Bạn có thể nêu thêm nhiều lí do khác</small>
    <textarea type="password" class="form-control" id="content" placeholder="Lí do khác"></textarea>
  </div>

  <button user_id="{{Auth::id()}}" friend_id="{{$data[0]->id}}" type="submit" id="submit-report" class="btn btn-primary">Báo cáo </button>
</form>
</div>