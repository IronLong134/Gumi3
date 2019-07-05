<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <script src="{{ asset('js/app.js') }}" defer></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
<div class="container"><section class="content-header">


    <div class="container">

      <nav class="navbar navbar-expand-lg navbar-light bg-primary ">
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03"
                aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand text-white" href="\home"><i
              class="far fa-newspaper"></i> Bảng tin
        </a>


        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link text-white"
                 href="/profile_post/"><img
                    class=" avatar1"
                    src=""
                    alt=""> Long <span
                    class="sr-only">(current)</span></a>
            </li>
            <input type="hidden" id="id_user" value="">
            <li class="nav-item">
              <a class="nav-link text-white"
                 href=""><i
                    class="fas fa-envelope-open-text"></i>Lời mời kết
                bạn<span class="badge badge-danger"><r class="rq"></r></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white"
                 href="/list_chat/"><i
                    class="fas fa-envelope-open-text"></i>
                Tin nhắn<span class="badge badge-danger"><msg class="msg"></msg></span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white"
                 href=""><i
                    class="fas fa-user-friends"></i>Bạn bè(
                <f class="fri"></f>
                )</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="/all_people"><i
                    class="fas fa-users"></i>Mọi người</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            {{csrf_field()}}

            <input class="form-control mr-sm-2" id="myInput" type="search" placeholder="Search"
                   aria-label="Search" required>
            <button class="btn btn-info my-2 my-sm-0" type="submit">Search
            </button>
          </form>
        </div>
      </nav>
    </div>

  </section>
</div>

</body>
</html>