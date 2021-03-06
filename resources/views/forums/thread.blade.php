@extends('layouts.master')

@section('title', $thread->title)
@section('body_class', 'blurbg')

@section('content')
    <div class="container">
        <section class="forum-display">
            <div class="row">
                <div class="col-md-8">
                    <h2>{{ $thread->title }}</h2>
                </div>
                <div class="col-md-4 text-right forum-form">
                    <a class="btn btn-primary post-reply" href="#post-reply">Post Reply</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h3><a href="/forums">Forums</a> / <a href="/forums/{{ $thread->forum->slug }}">{{ $thread->forum->name }}</a></h3>
                </div>
                <div class="col-md-4 text-right">
                    {!! $replies->render() !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr/>
                </div>
            </div>

            <!-- Display the opening post -->
            <div class="opening-post">
                @include('partials.forums.post', ['post' => $thread])
            </div>

            <!-- Loop through the replies -->
            @foreach ($replies as $reply)
                @include('partials.forums.post', ['post' => $reply])
            @endforeach

            <div class="row">
                <div class="col-md-12 text-right">
                    {!! $replies->render() !!}
                </div>
            </div>

            @if(Auth::user()->hasRole('administrators'))
                <div class="row">
                    <div class="col-md-12 text-right">
                        <div class="forum-form">
                            <form method="POST" id="admin_thread_controls" action="/thread/controls">
                                {!! csrf_field() !!}
                                <input type="hidden" name="post_id" value="{{ $thread->id }}" />
                                <select name="mod_thread" id="mod_controls">
                                        <option selected disabled>Thread Controls</option>
                                    @if($thread->sticky)
                                        <option value="unstick">Unsticky Thread</option>
                                    @else
                                        <option value="stick">Stick Thread</option>
                                    @endif

                                    @if($thread->announcement)
                                        <option value="unannounce">Unannounce Thread</option>
                                    @else
                                        <option value="announce">Announce Thread</option>
                                    @endif
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <div class="post-reply-form forum-form">
                        <h3><a name="post-reply"></a>Post Reply</h3>
                        <form method="POST" action="/post/create">
                            {!! csrf_field() !!}

                            <input type="hidden" name="forum_id" value="{{ $thread->forum_id }}" />
                            <input type="hidden" name="thread_id" value="{{ $thread->id }}" />
                            <input type="hidden" name="title" value="{{ $thread->title }}" />

                            <div>
                                <textarea id="post-content" name="content" class="form-control post-content-textarea" tabindex="2"></textarea>
                                </div>

                            <div>
                                <button id="submit" type="submit" class="btn btn-primary">Post Reply</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <h3>Live Preview</h3>
                    <div id="live-preview-post-content"></div>
                </div>
            </div>

        </section>
    </div>
@stop
