@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Posts
                        <span class="right">
                            {{ Form::label('active', 'Active post') }}
                            {{ Form::checkbox('active', $active, $active, ['id' => 'active']) }}
                        </span>
                    </div>
                    <div class="panel-body">
                        @forelse ($posts as $post)
                            <h4>{{ $post->title }}</h4>
                            <p>{{ $post->body }}</p>
                        @empty
                            <p>No posts :(</p>
                        @endforelse
                    </div>
                </div>
                <a href="{{ route('posts.create') }}">Create new post</a>
            </div>
        </div>
    </div>
@endsection