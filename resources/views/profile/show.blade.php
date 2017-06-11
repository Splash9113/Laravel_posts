@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$user->name}}</div>
                    <div class="panel-body">
                        <div class="col-md-4">
                            {{--avatar--}}
                        </div>
                        <div class="col-md-8">
                            @if ($user->status)
                                <div class="row">
                                    <label class="control-label col-sm-2" for="status">Status</label>
                                    <div class="col-sm-10">
                                        {{$user->status}}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection