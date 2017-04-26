@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create Post</div>
                    <div class="panel-body">
                        {{ Form::open(['route' => ['posts.store'], 'class' => 'form-horizontal']) }}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Title</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" id="title" name="title" value="{{old('title')}}">
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
                                <textarea class="form-control vertical-resize" rows="3" id="body" name="body">{{old('body')}}</textarea>
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
                            <div class="col-sm-offset-2 col-sm-7">
                                <div class="checkbox">
                                    <label><input type="checkbox" value="1" name="active" {{ old('active') ? 'checked' : '' }}>Active</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <button class="btn btn-default" type="submit">Save</button>
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