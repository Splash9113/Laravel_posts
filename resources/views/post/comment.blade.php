@if(count($comments) || Auth::check())
    <div class="panel panel-default">
        <div class="panel-heading">Comments</div>
        <div class="panel-body">
            @forelse($comments as $comment)
                <div class="row">
                    <div class="col-sm-12">{{$comment->created_at}}</div>
                </div>
                <div class="row comment">
                    <label class="control-label col-sm-2" for="comment">{{\App\User::findOrFail($comment->user_id)->name}}</label>
                    <div class="col-sm-10" id="comment">
                        @can('destroy', [$comment, $post])
                            <form action="/posts/{{ $post->id }}/comments/{{ $comment->id }}" method="POST"
                                  onsubmit="return confirm('Do you really want to remove this comment?');">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn-link right"><i class="glyphicon glyphicon-trash"></i></button>
                            </form>
                        @endcan
                        {{$comment->body}}
                    </div>
                </div>
            @empty
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-2">No comments.</div>
                </div>
            @endforelse
            @if(Auth::check())
                <div class="row new-comment">
                    {{ Form::open(['route' => ['comments.store', $post['id']], 'method' => 'post', 'class' => 'form-horizontal']) }}
                    <div class="col-sm-10">
                        <input class="form-control" placeholder="Leave your comment..." name="body">
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-info btn-wide">Send</button>
                    </div>
                    {{ Form::close() }}
                </div>
            @endif
        </div>
    </div>
@endif
