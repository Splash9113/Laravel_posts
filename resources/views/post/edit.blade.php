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
                                <input id="title" name="title" type="text" class="form-control" value="{{$post->title}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="body">Body</label>
                            <div class="col-sm-10">
                                <textarea id="body" name="body" rows="3" class="form-control">{{$post->body}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-7">
                                <div class="checkbox">
                                    <label><input name="active" type="checkbox" value="1" {{$post->active ? 'checked' : ''}}>Active</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <button class="btn btn-info" type="submit">Update</button>
                                <a class="btn btn-danger" href="{{ route('posts.index') }}">Cancel</a>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection