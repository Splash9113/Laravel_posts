@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Your profile</div>
                    <div class="panel-body">
                        <div class="col-md-4">
                            <img class="user-avatar" src="{{url('/').'/'.($user->image->img_url ?? 'image/avatar_placeholder.png')}}">
                            {{ Form::open(['route' => ['image.upload'], 'files' => 'true']) }}
                            <div class="form-group">
                                <div class="input-group">
                                    <label class="input-group-btn">
                                    <span class="btn btn-primary">
                                        Browse&hellip; <input type="file" accept="text/plain" style="display: none;" name="file">
                                    </span>
                                    </label>
                                    <input type="text" class="form-control" readonly>
                                </div>
                            </div>
                            @if ($errors->has('file'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-danger">
                                            <strong>Danger!</strong> {{$errors->first('file')}}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <button class="btn btn-block btn-success">Download</button>
                            </div>
                            {{ Form::close() }}
                        </div>
                        <div class="col-md-8">
                            {{ Form::open(['route' => ['profile.update'], 'class' => 'form-horizontal']) }}
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="name">Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="name" name="name" value="{{old('name') ?? $user->name}}">
                                </div>
                            </div>
                            @if ($errors->has('name'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-danger">
                                            <strong>Danger!</strong> {{$errors->first('name')}}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="status">Status</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" id="status" name="status" value="{{old('status') ?? $user->status}}">
                                </div>
                            </div>
                            @if ($errors->has('status'))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-danger">
                                            <strong>Danger!</strong> {{$errors->first('status')}}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-offset-10 col-md-2">
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </div>
                            {{ Form::close() }}
                            {{ Form::open(['route' => ['profile.destroy'], 'class' => 'form-horizontal']) }}

                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection