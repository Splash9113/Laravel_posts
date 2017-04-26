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
                            <h4>
                                @can ('update', $post)
                                    <a href="{{ route('posts.edit', $post->id) }}">{{ $post->title }}</a>
                                    <form action="/posts/{{ $post->id }}?active={{$active}}" method="POST"
                                          onsubmit="return confirm('Do you really want to remove this post?');">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn-link right"><i class="glyphicon glyphicon-trash"></i></button>
                                    </form>
                                @else
                                    <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                                @endcan
                            </h4>
                            <p>{{ $post->body }}</p>
                        @empty
                            <p>No posts</p>
                        @endforelse
                    </div>
                </div>
                @if (!Auth::guest())
                    <a href="{{ route('posts.create') }}">Create new post</a>
                @endif
            </div>
        </div>
    </div>
@endsection