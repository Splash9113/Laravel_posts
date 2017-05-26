@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Chats</div>
                    <div class="panel-body">
                        @forelse ($chats as $chat)
                            <h4>
                                <a href="{{ route('message.chat', 1) }}">UserName</a>
                            </h4>
                            <p>MessageText</p>
                        @empty
                            <p>No chats</p>
                        @endforelse
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Start new chat</div>
                    <div class="panel-body">
                        @forelse ($users as $user)
                            <h4>
                                <a href="{{ route('message.chat', $user->id) }}">{{$user->name}}</a>
                            </h4>
                        @empty
                            <p>No new users</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection