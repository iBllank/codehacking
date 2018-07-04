@extends('layouts.blog-post')



@section('content')


    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by {{$post->user->name}}
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo->file}}" alt="">

    <hr>
    <!-- Post Content -->

    <h3>{{$post->body}}</h3>

    <hr>

    <!-- Blog Comments -->


    @if(Auth::check())

    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>



    {!! Form::open(['method'=>'POST', 'action'=>'PostsCommentsController@store']) !!}

        <input type="hidden" name="post_id" value="{{$post->id}}">


        <div class="form-group">
            {!! Form::label('body','Body:') !!}
            {!! Form::textarea('body',null,['class'=>'form-control','rows'=>3]) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Comment', ['class'=>'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}
    </div>

    @endif

    <hr>

    <!-- Posted Comments -->

    @if(count($comments) > 0)

        @foreach($comments as $comment)
    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img height="64" class="media-object" src="{{$comment->photo}}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->author}}
                <small>{{$comment->created_at->diffForHumans()}}</small>
            </h4>
            {{$comment->body}}
        </div>

    @if(count($comment->replies) > 0)

        @foreach($comment->replies as $reply)

        <!-- Nested Comment -->
        <div id="nested-comment" class="media">
            <a class="pull-left" href="#">
                <img height="50" class="media-object" src="{{$reply->photo}}" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{$reply->author}}
                    <small>{{$reply->created_at->diffForHumans()}}</small>
                </h4>
                    {{$reply->body}}
            </div>

            {!! Form::open(['method'=>'POST', 'action'=>'CommentReplyController@createReply']) !!}
                <div class="form-group">

                    <input type="hidden" name="comment_id" value="{{$comment->id}}">


                    {!! Form::label('body','Reply:') !!}
                    {!! Form::textarea('body',null,['class'=>'form-control','rows'=>1]) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Reply', ['class'=>'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>

        @endforeach

        @endif


        <!-- End Nested Comment -->
    </div>

    @endforeach

    @endif


    @stop