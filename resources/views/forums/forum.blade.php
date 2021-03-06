@extends('layouts.master')

@section('title', 'Forums')
@section('body_class', 'blurbg')

@section('content')
    <div class="container">
        <section class="forum-display">
            <div class="row">
                <div class="col-md-12">
                    <h2>Recent Topics</h2>
                    <hr/>
                </div>
            </div>
            <div class="row">
                @foreach($latest_posts as $post)
                     <div class="col-md-3">
                         <a href="/thread/{{ $post->id }}/{{ $post->slug }}" class="recent-topic recent-{{ $post->forum->slug }}">
                             <h4>{{ $post->title }}</h4>
                             <span><strong>{{ $post->forum->name }}</strong> &nbsp;{!! Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans(); !!} </span>
                             <div class="reply_count"> {{ $post->reply_count }}</div>
                         </a>
                     </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>Categories</h2>
                    <hr/>
                    @foreach($forums as $forum)
                        <div class="row forum-row row-{{ $forum->slug }}">
                            <div class="col-sm-1">
                                <div class="forum-icon icon-{{ $forum->slug }}"></div>
                            </div>
                            <div class="col-sm-5">
                                <h3><a href="/forums/{{$forum->slug}}">{{ $forum->name }}</a></h3>
                                <p>
                                    {{ $forum->description }}
                                </p>
                            </div>
                            <div class="col-sm-1 text-center">
                                <h3>{{ $forum->post_count }}</h3>
                                <p class="count-description">Topics</p>
                            </div>
                            <div class="col-sm-1 text-center">
                                <h3>{{ $forum->reply_count }}</h3>
                                <p class="count-description">Replies</p>
                            </div>
                            <div class="col-sm-4">
                                <div class="latest-reply">
                                    @if ($forum->latest_reply)
                                        <strong>{{ $forum->latest_reply->user->character_name }}</strong> {!! Carbon::createFromTimeStamp(strtotime($forum->latest_reply->created_at))->diffForHumans(); !!}
                                        <p>
                                            {{ str_limit($forum->latest_reply->content, 50) }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2>Users Online</h2>
                    <hr />
                    @foreach($online_users as $user)
                        <a href="/profile/{{ $user->id }}/{{ $user->profile_slug }}">{{ $user->character_name }}</a>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@stop
