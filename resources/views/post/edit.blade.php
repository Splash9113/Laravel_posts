@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">View Post</div>
                    <div class="panel-body">
                        {{ Form::open(['route' => ['posts.update', $post['id']], 'method' => 'put', 'class' => 'form-horizontal']) }}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Title</label>
                            <div class="col-sm-10">
                                <input id="title" name="title" type="text" class="form-control" value="{{old('title') ?? $post->title}}">
                            </div>
                        </div>
                        @if ($errors->has('title'))
                            <div class="row">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="alert alert-danger">
                                        <strong>Danger!</strong> {{$errors->first('title')}}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="body">Body</label>
                            <div class="col-sm-10">
                                <textarea id="body" name="body" rows="3" class="form-control">{{old('body') ?? $post->body}}</textarea>
                            </div>
                        </div>
                        @if ($errors->has('body'))
                            <div class="row">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="alert alert-danger">
                                        <strong>Danger!</strong> {{$errors->first('body')}}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <div class="checkbox">
                                    <label><input name="active" type="checkbox" value="1" {{$post->active ? 'checked' : ''}}>Active</label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-info btn-wide" type="submit">Update</button>
                            </div>
                            <div class="col-sm-2">
                                <a class="btn btn-danger btn-wide" href="{{ route('posts.index') }}">Cancel</a>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
                @include('post.comment')
            </div>
        </div>
    </div>
@endsection