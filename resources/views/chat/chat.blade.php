@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$chat->chatName}}</div>
                    <div class="panel-body">
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
                        <div class="row new-comment">
                            {{ Form::open(['route' => ['message.send', $chat->id], 'method' => 'post', 'class' => 'form-horizontal']) }}
                            <div class="col-sm-10">
                                <input class="form-control" placeholder="Enter message..." name="body" value="{{old('body')}}">
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-info btn-wide">Send</button>
                            </div>
                            {{ Form::close() }}
                        </div>
                        @if ($errors->has('body'))
                            <div class="row has-error">
                                <div class="col-sm-10">
                                    <div class="alert alert-danger">
                                        <strong>Danger!</strong> {{$errors->first('body')}}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection