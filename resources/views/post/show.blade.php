@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">View Post</div>
                    <div class="panel-body">
                        <div class="row">
                            <label class="control-label col-sm-2" for="title">Title</label>
                            <div class="col-sm-10">
                                {{$post->title}}
                            </div>
                        </div>
                        <div class="row">
                            <label class="control-label col-sm-2" for="body">Body</label>
                            <div class="col-sm-10">
                                {{$post->body}}
                            </div>
                        </div>
                        <div class="row">
                            <label class="control-label col-sm-2" for="body">Is active</label>
                            <div class="col-sm-10">
                                {{$post->active ? 'Yes' : 'No'}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection