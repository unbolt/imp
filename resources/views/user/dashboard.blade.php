@extends('layouts.master')

@section('title', 'Dashboard')
@section('body_class', 'blurbg')

@section('content')
    @include('partials.user.header', ['user' => $user])

    <div class="container">
        <section class="user-dashboard">
            <div class="row">
                <div class="col-md-2">
                    <div class="icon-container" role="tablist">
                        <a href="#home" class="icon icon-home" aria-controls="home" role="tab" data-toggle="tab"></a>
                        <a href="#character-config" class="icon icon-character-config" aria-controls="character-config" role="tab" data-toggle="tab"></a>
                        <a href="#account-config" class="icon icon-config" aria-controls="account-config" role="tab" data-toggle="tab"></a>
                        @if(Entrust::hasRole('administrators'))
                        <a href="#site-config" class="icon icon-site-config" aria-controls="site-config" role="tab" data-toggle="tab"></a>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="panel panel-highlight">
                                <div class="panel-heading">Latest Mentions</div>
                                <ul class="list-group">
                                    @foreach($mention_posts as $post)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="user-avatar-round" style="background-image: url('{{ $post->user->character_avatar }}');"></div>
                                                </div>
                                                <div class="col-md-10">
                                                    <div class="date">
                                                        {!! Carbon::createFromTimeStamp(strtotime($post->updated_at))->diffForHumans(); !!}
                                                    </div>
                                                    <div>
                                                        <a href="/profile/{{ $post->user->id }}/{{ $post->user->profile_slug }}">{{ $post->user->character_name or $post->user->name }}</a> mentioned you in <a href="/thread/{{ $post->thread->id }}/{{ $post->thread->slug }}">{{ $post->thread->title }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="character-config">
                            <h3>Profile Configuration</h3>
                            <hr/>
                            @include('partials.user.profile-configuration', ['user' => $user])
                        </div>
                        <div role="tabpanel" class="tab-pane" id="account-config">
                            <h3>Account Configuration</h3>
                            <hr/>
                        </div>

                        @if(Entrust::hasRole('administrators'))
                        <div role="tabpanel" class="tab-pane" id="site-config">
                            <h3>Site Configuration</h3>
                            <hr/>
                            @include('partials.administration.site-configuration', ['group_list' => $group_list, 'group_array' => $group_array, 'users_array' => $users_array])
                        </div>
                        @endif
                        <div role="tabpanel" class="tab-pane" id="other"></div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-dark">
                        <div class="panel-heading">Recent Posts</div>
                        <ul class="list-group">
                            @foreach($latest_posts as $recent_post)
                                <li class="list-group-item">

                                    <div class="date">
                                        {!! Carbon::createFromTimeStamp(strtotime($recent_post->updated_at))->diffForHumans(); !!}
                                    </div>
                                    <div>
                                        <a href="/profile/{{ $recent_post->user->id or 'id' }}/{{ $recent_post->user->profile_slug or 'slug' }}">{{ $recent_post->user->character_name or $recent_post->user->name }}</a> posted in <a href="/thread/{{ $recent_post->thread->id or $recent_post->id }}/{{ $recent_post->thread->slug or $recent_post->slug }}">{{ $recent_post->thread->title or $recent_post->title }}</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
