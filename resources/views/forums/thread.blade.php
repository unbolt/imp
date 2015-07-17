@extends('layouts.master')

@section('title', $thread->title)
@section('body_class', 'blurbg')

@section('content')
    <div class="container">
        <section class="forum-display">
            <div class="row">
                <div class="col-md-8">
                    <h2>{{ $thread->title }}</h2>
                    <h3><a href="/forums">Forums</a> / <a href="/forums/{{ $thread->forum->slug }}">{{ $thread->forum->name }}</a></h3>

                </div>
                <div class="col-md-4 text-right forum-form">
                    <button class="btn btn-primary post-reply">Post Reply</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="post-reply-form">
                        <h2>Reply</h2>
                        <form method="POST" action="/post/create">
                            {!! csrf_field() !!}

                            <input type="hidden" name="forum_id" value="{{ $thread->forum_id }}" />
                            <input type="hidden" name="thread_id" value="{{ $thread->id }}" />
                            <input type="hidden" name="title" value="{{ $thread->title }}" />

                            <div>
                                <textarea name="content" class="form-contronl" tabindex="2"></textarea>
                                </div>

                            <div>
                                <button id="submit" type="submit" class="btn btn-primary">Post Reply</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr/>
                </div>
            </div>

            <!-- Display the opening post -->
            @include('partials.forums.post', ['post' => $thread])

            <!-- Loop through the replies -->
            @foreach ($replies as $reply)
                @include('partials.forums.post', ['post' => $reply])
            @endforeach

        </section>
    </div>
@stop
