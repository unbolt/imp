@extends('layouts.master')

@section('title', 'Forums')
@section('body_class', 'blurbg')

@section('content')
    <div class="container">
        <section class="forum-display">
            <div class="row">
                <div class="col-md-8">
                    <h2><a href="/forums">Forums</a> / {{ $forum->name }}</h2>
                </div>
                <div class="col-md-4 text-right forum-form">
                    <button class="btn btn-primary new-topic">New Topic</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="new-topic-form">
                        <hr/>

                        <div class="row">
                            <div class="col-md-6">
                                <h3>New Topic</h3>
                                <div class="forum-form">
                                    <form method="POST" action="/post/create">
                                        {!! csrf_field() !!}

                                        <input type="hidden" name="forum_id" value="{{ $forum->id }}" />

                                        <div>
                                            <input id="thread-title" type="text" name="title" placeholder="Thread Title" value="{{ old('title') }}" class="form-control" tabindex="1" autocomplete="off" autocorrect="off" spellcheck="false">
                                        </div>

                                        <div>
                                            <textarea id="thread-content" name="content" class="form-control post-content-textarea" tabindex="2">{{ old('content') }}</textarea>
                                            </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <button id="submit" type="submit" class="btn btn-primary">Post Topic</button>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <a class="btn btn-link" href="http://imgur.com/" target="_blank">Image Hosting</a>
                                                <a class="btn btn-link" href="http://markdown-guide.readthedocs.org/en/latest/basics.html" target="_blank">Markdown Help</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>Live Preview</h3>
                                <h4 id="live-preview-thread-title"></h4>
                                <div id="live-preview-thread-content"></div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <hr/>
                </div>
            </div>

            <section class="thread-list">
            @foreach($threads as $thread)
                <div class="row thread-row @if($thread->announcement) thread-announcement @endif @if($thread->sticky) thread-sticky @endif">
                    <div class="col-sm-1">
                        <a href="/profile/{{ $thread->user->id }}/{!! str_slug($thread->user->character_name, '-') !!}"><div class="user-avatar" style="background-image: url('{{ $thread->user->character_avatar or '/img/profile_avatar_default.png' }}');"></div></a>
                    </div>
                    <div class="col-md-5">
                        <h3>
                            @if($thread->announcement)
                                <span class="announcement badge">Announcement</span>
                            @endif
                            @if($thread->sticky)
                                <span class="sticky badge">Sticky</span>
                            @endif
                            <a href="/thread/{{ $thread->id }}/{{ $thread->slug }}">{{ $thread->title }}</a>
                        </h3>
                        <p class="thread-description">posted {!! Carbon::createFromTimeStamp(strtotime($thread->created_at))->diffForHumans(); !!} by <strong>{{ $thread->user->character_name or $thread->user->name }}</strong></p>
                    </div>
                    <div class="col-md-1 text-center">
                        <h3>{{ $thread->view_count }}</h3>
                        <p class="count-description">
                            @if( $thread->view_count == 1 )
                                view
                            @else
                                views
                            @endif
                        </p>
                    </div>
                    <div class="col-md-1 text-center">
                        <h3>{{ $thread->reply_count }}</h3>
                        <p class="count-description">
                            @if( $thread->reply_count == 1 )
                                reply
                            @else
                                replies
                            @endif
                        </p>
                    </div>
                    <div class="col-md-4">
                        <div class="latest-reply">
                            @if ($thread->latest_reply)
                                <strong>{{ $thread->latest_reply->user->character_name }}</strong> {!! Carbon::createFromTimeStamp(strtotime($thread->latest_reply->created_at))->diffForHumans(); !!}
                                <p>
                                    {{ str_limit($thread->latest_reply->content, 50) }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            {!! $threads->render() !!}
            </section>
        </section>
    </div>
@stop
