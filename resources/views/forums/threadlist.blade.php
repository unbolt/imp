@extends('layouts.master')

@section('title', 'Forums')
@section('body_class', 'blurbg')

@section('content')
    <div class="container">
        <section class="forum-display">
            <div class="row">
                <div class="col-md-8">
                    <h2>Forums / {{ $forum->name }}</h2>
                </div>
                <div class="col-md-4 text-right">
                    <button class="btn">New Topic</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="new_topic">
                        <h2>New Topic</h2>
                        <form method="POST" action="/post/create">
                            {!! csrf_field() !!}

                            <input type="hidden" name="forum_id" value="{{ $forum->id }}" />

                            <div>
                                <input type="text" name="title" placeholder="Thread Title" class="form-control" tabindex="1" autocomplete="off" autocorrect="off" spellcheck="false">
                            </div>

                            <div>
                                <textarea name="content" class="form-contronl" tabindex="2"></textarea>
                                </div>

                            <div>
                                <button id="submit" type="submit" class="btn btn-primary">Post Topic</button>
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

            <section class="thread-list">
            @foreach($threads as $thread)
                <div class="row thread-row">
                    <div class="col-sm-1">
                        <a href="/profile/{{ $thread->user->id }}/{!! str_slug($thread->user->character_name, '-') !!}"><div class="user-avatar" style="background-image: url('{{ $thread->user->character_avatar or '/img/profile_avatar_default.png' }}');"></div></a>
                    </div>
                    <div class="col-md-5">
                        <h3><a href="/thread/{{ $thread->id }}/{{ $thread->slug }}">{{ $thread->title }}</a></h3>
                        <p class="thread-description">posted {!! Carbon::createFromTimeStamp(strtotime($thread->created_at))->diffForHumans(); !!} by <strong>{{ $thread->user->character_name or $thread->user->name }}</strong></p>
                    </div>
                    <div class="col-md-1 text-center">
                        <h3>{{ $thread->view_count }}</h3>
                        <p class="count-description">views</p>
                    </div>
                    <div class="col-md-1 text-center">
                        <h3>{{ $thread->reply_count }}</h3>
                        <p class="count-description">replies</p>
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
            </section>
        </section>
    </div>
@stop
