@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$chat->chatName}}</div>
                    <div class="panel-body">
                        <div data-chat>
                            @forelse ($messages as $message)
                                <div class="row">
                                    @if ($message->from == Auth::user())
                                        <div class="col-xs-1 chat-msg name your-chat-msg">You:</div>
                                    @else
                                        <div class="col-xs-1 chat-msg name">{{$message->from->name}}:</div>
                                    @endif
                                    <div class="col-xs-11">{{$message->body}}</div>
                                </div>
                            @empty
                                <p>This chat is empty</p>
                            @endforelse
                        </div>
                        <div class="row new-comment">
                            {{ Form::open(['class' => 'form-horizontal', 'id' => 'message']) }}
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter message..." name="body">
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-info btn-wide">Send</button>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts for web-sockets -->
    <script>
        window.requestUrl = '{{route('chat.send', $chat->id)}}';
        console.log(window.requestUrl);
    </script>
    <script src="//localhost:6001/socket.io/socket.io.js"></script>
    <script src="{{elixir('/js/web-sockets.js')}}"></script>

@endsection