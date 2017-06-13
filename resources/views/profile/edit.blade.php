@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Your profile</div>
                    <div class="panel-body">
                        <div class="col-md-4">
                            {{ Form::open(['route' => ['avatar.delete']]) }}
                            <div class="img-wrap">
                                @if ($user->image)
                                    <button class="btn-link close" type="submit">&times;</button>
                                @endif
                                <img class="user-avatar" src="{{$user->full_img_url}}">
                            </div>
                            {{ Form::close() }}
                            {{ Form::open(['route' => ['avatar.upload'], 'files' => 'true']) }}
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
                            <div class="row text-right">
                                <div class="col-md-12">
                                    <a class="btn btn-default" href="{{route('profile.index')}}">Cancel</a>
                                    <button class="btn btn-primary">Update</button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                        <form action="{{route('profile.destroy')}}" method="POST"
                              onsubmit="return confirm('Do you really want to remove your profile?');">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <div class="row text-right delete-row">
                                <div class="col-md-12">
                                    <button class="btn btn-link delete-link">Delete Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection