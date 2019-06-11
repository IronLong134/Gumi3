@extends('layouts.app')
{{--<script src="{{ asset('js/autoload.js') }}" defer></script>--}}
@section('content')
  <div class="container">
    <div class="card-body container">
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif
      <div class="container">
        <input type="hidden" name="csrf-token" content="{{ csrf_token() }}">
        <div class="" id="myTable">
          <div class="card container border-primary chat-box">
            <div class="card-header bg-primary text-center name header-chat"><img class=" avatar2"
                                                                                             src="{{ url('/') }}/imgs/@if($friend[0]->avatar){{$friend[0]->avatar}}@elseif(!$friend[0]->avatar && $user->gender==1){{"avatar_male.jpg"}}@else{{"avatar_female.jpg"}}@endif"
                                                                                             alt="">{{$friend[0]->name}}</div>
            <div class="container card  border-primary text-list" id="list-msg">
              @foreach($messengers as $messenger)
                @if($messenger->from=='friend')
                  <div class="chat-wrapper">
                    <div class="img-chat"><img class=" avatar1"
                                               src="{{ url('/') }}/imgs/@if($messenger['sender_info']->avatar){{$messenger['sender_info']->avatar}}@elseif(!$messenger['sender_info']->avatar && $messenger['sender_info']->gender==1){{"avatar_male.jpg"}}@else{{"avatar_female.jpg"}}@endif"
                                               alt=""></div><div class="card border-primary me-chat">{{$messenger->content}}</div>
                  </div>
                 @elseif($messenger->from=='me')
                  <div class="chat-wrapper">
                    <div class="img-chat2"><img class=" avatar1"
                                                src="{{ url('/') }}/imgs/@if($messenger['sender_info']->avatar){{$messenger['sender_info']->avatar}}@elseif(!$messenger['sender_info']->avatar && $messenger['sender_info']->gender==1){{"avatar_male.jpg"}}@else{{"avatar_female.jpg"}}@endif"
                                                alt=""></div>
                    <div class="bg-primary text-white card friend-chat">{{$messenger->content}}</div>

                  </div>
                  @endif
                @endforeach
            </div>
            <form id="form-chat" class="form-chat" >
              <input type="hidden" id="data" user_id="{{Auth::id()}}" friend_id="{{$friend[0]->id}}" avatar="{{Auth::user()->avatar}}" gender="{{Auth::user()->gender}}">
              <input id="input-chat" type="text" class="form-control card container border-primary text-chat" placeholder="Nhập tin nhắn đi nào" required autofocus>
            </form>
            <div class="text-center">
              <button class="btn sticker" icon="far fa-sad-tear"><i class="far fa-sad-tear"></i></button>
              <button  class="btn sticker" icon="far fa-grin-squint"><i class="far fa-grin-squint"></i></button>
              <button  class="btn sticker" icon="fas fa-heart"><i class="fas fa-heart"></i></button>
              <button  class="btn sticker" icon="far fa-kiss-wink-heart" ><i class="far fa-kiss-wink-heart"></i></button>
            </div>

          </div>

        </div>

      </div>
    </div>

  </div>
  <script src="{{ asset('js/chat.js') }}" defer></script>

@endsection
