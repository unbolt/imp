@extends('layouts.master')

@section('title', 'Dashboard')
@section('body_class', 'blurbg')

@section('content')
    @include('partials.user.header', ['user' => $user])

    <div class="container">
        <section class="user-actions">
            <div class="row">
                <div class="col-md-2">
                    <div class="icon-container" role="tablist">
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
                            <h3>Welcome back!</h3>
                            <hr/>
                            @foreach($mention_posts as $post)
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="user-avatar-round" style="background-image: url('{{ $post->user->character_avatar }}');"></div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="date">
                                            {!! Carbon::createFromTimeStamp(strtotime($post->updated_at))->diffForHumans(); !!}
                                        </div>
                                        <a href="/thread/{{ $post->user->id }}/{{ $post->user->profile_slug }}">{{ $post->user->character_name or $post->user->name }}</a> mentioned you in <a href="/thread/{{ $post->thread->id }}/{{ $post->thread->slug }}">{{ $post->thread->title }}</a>
                                    </div>
                                </div>
                                <hr/>
                            @endforeach
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
                    latest?
                </div>
            </div>
        </section>
    </div>
@stop
