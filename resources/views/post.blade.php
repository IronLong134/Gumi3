@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="card-body">
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif
      <div class='row'>
        <div class="col-md-4 card">
          <div class="box box-primary">
            <div class="box-body box-profile" style="margin-top:7px;">
              <input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
              <img class="rounded mx-auto d-block avatar"
                   src="{{ url('/') }}/imgs/@if($post[0]->user->avatar){{$post[0]->user->avatar}}@elseif(!$post[0]->user->avatar && $post[0]->user->gender==1){{"avatar_male.jpg"}}@else{{"avatar_female.jpg"}}@endif"
                   alt="User profile picture">
              <h3 class="profile-username text-center name1 text-primary">{{$post[0]->user->name}}</h3>

              <p class="text-muted text-center">Software Engineer</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item center">
                  <b>Followers</b> <a class="pull-right">1,322</a>
                </li>
                <li class="list-group-item center">
                  <b>Following</b> <a class="text-right">543</a>
                </li>
                <li class="list-group-item center">
                  <b>Friends</b> <a class="text-right">13,287</a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->


          </div>
          <a class="btn btn-primary" href="/home">Trang chủ</a><br>
          <label></label>
          <a class="btn btn-primary" href="/profile_post/{{$user->id}}">Trang cá nhân của tôi</a><br>
          <label></label>
        </div>
        <div class="col-md-8 card">
          <div class="user-block">
            <div class="inline"><img class=" avatar1" src="{{ url('/') }}/imgs/{{$post[0]->user->avatar}}"
                                     alt="">
              <a class="name" href="#" style="font-size:x-large;">{{$post[0]->user->name}}</a>
              <div class="description">Shared publicly {{$post[0]['created_at']}}</div>
            </div>

            <div style="height:120px; padding-top:13px; margin-bottom:-13px;"
                 class="bg-primary text-white center">{{$post[0]['content']}}</div>
            <br>
            <div class="row" style="margin-bottom:7px;">
              <div class="col-md-1">
                <div>
                  <a id="like_btn" href="javascript:void(0)"
                     class="@if($post['checkLike']!='liked')btn btn-primary @else btn btn-danger @endif "
                     action="0"
                     post_id="{{$post[0]->id}}"><i class="far fa-thumbs-up"></i>
                    Like(<b>{{count($post[0]->like)}}</b>)</a>
                </div>
              </div>
              <div class="col-md-2" style="margin-left:40px">
                <button class="btn btn-primary"><i
                      class="fas fa-comments"></i>Comments(
                  <c>{{count($comments)}}</c>
                  )
                </button>
              </div>
            </div>

            <div class="div-wraper">
            @foreach ($comments as $comment)
                <div class="form-inline post">
                  <div class="inline"><img class=" avatar1"
                                           src="{{ url('/') }}/imgs/{{$comment->user->avatar}}"
                                           alt=""><a
                        href="/profile_post/{{$comment->user->id}}">{{$comment->user->name}}</a>
                    <span style="margin-left:11px;">{{$comment->content}}</span>

                  </div>
                  @if($comment->edit==1)
                    <div class="text-primary delete">
                      <i class="fas fa-trash-alt"></i><span><a  class="delete_cmt" cmt_id="{{$comment->id}}"
                                                                href="javascript:void(0)">xóa</a></span>

                    </div>
                  @endif
                </div>

                @endforeach
              </div>
              <form class="form-horizontal" style="margin-top:10px"
                    method="POST">
                {{csrf_field()}}
                <div class="form-group margin-bottom-none">
                  <div class="row">
                    <div class="col-sm-8">
                      <input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
                      <input type="hidden" name="avatar" value="{{$user->avatar}}">
                      <input type="hidden" name="user_id" value="{{$user->id}}">
                      <input type="hidden" name="name" value="{{$user->name}}">
                      <input type="hidden" name="post_id" value="{{$post[0]->id}}">
                      <input class="form-control input-sm" name="content"
                             placeholder="type a comment" required>
                    </div>
                    <div class="col-sm-3">
                      <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send
                      </button>
                    </div>
                  </div>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>

  </div>
  <script type="text/javascript">
		$(document).ready(function () {
			$("#like_btn").click(function (e) {
				e.preventDefault();
				var id = $(this).attr("post_id"); //lay id video\
				var url = '/' + id + '/addLike';

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
						id: id
					},
					success: function (res) {
						var this_a = $("#like_btn");
						var likeclass = res.data.success ? 'btn-danger' : 'btn-primary';
						this_a.removeClass('btn-danger');
						this_a.removeClass('btn-primary');
						this_a.addClass(likeclass);
						$('b').html(res.data.likes);
					}
				});
				return false;
			});
			$("button[type='submit']").click(function (e) {
				e.preventDefault();
				var content = $("input[name='content']").val();
				var post_id = $("input[name='post_id']").val();
				var user_id = $("input[name='user_id']").val();
				var name = $("input[name='name']").val();
				var avatar = $("input[name='avatar']").val();

				var data = $('form#form_input').serialize();
				var url = '/post/add_comment/' + post_id + '/' + user_id;
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
						content: content,
						post_id: post_id,
						user_id: user_id
					},
					success: function (res) {
						console.log(res);
						$('c').html(res.count);
						var comment = "<div class=\"form-inline post\">\n" +
								"                <div class=\"inline\"><img class=\" avatar1\" src=\"http://localhost:8000/imgs/"+avatar+"\" alt=\"\"><a href=\"/profile_post/1\">"+name+"</a>\n" +
								"                  <span style=\"margin-left:11px;\">"+ content +"</span>\n" +
								"\n" +
								"                </div>\n" +
								"                                  <div class=\"text-primary delete\">\n" +
								"                    <i class=\"fas fa-trash-alt\"></i><span><a class=\"delete_cmt\" cmt_id=\""+res.cmt_id+"\" href=\"javascript:void(0)\">xóa</a></span>\n" +
								"                  </div>\n" +
								"                              </div>";

						$('.div-wraper').append(comment);

					}
				});
				return false;

			});
			$("div.row").on('click', '.delete_cmt', function (e) {
				e.preventDefault();
				$(this).parent().parent().parent().remove();
				var cmt_id=$(this).attr("cmt_id");
				var post_id = $("input[name='post_id']").val();
				var url = '/delete_cmt';
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
						post_id: post_id,
						cmt_id: cmt_id
					},
					success: function (res) {
						console.log(res);
						$('c').html(res);
					}
				});
				return false;
			});

		});

  </script>
@endsection
