@extends('layouts.master')

@section('title', 'Profile')
@section('body_class', 'blurbg')

@section('content')
    @include('partials.user.header', ['user' => $user])

    <div class="container">
        <section class="profile-display">
            <div class="row">
                <div class="col-md-12">
                    <hr/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <section class="profile-stats">
                        <div class="row">
                            <div class="col-md-3"><div class="stat posts">{{ $user->post_count }} <span>Posts</span></div></div>
                            <div class="col-md-3"><div class="stat screenshots">? <span>Screenshots</span></div></div>
                            <div class="col-md-3"><div class="stat aether">? <span>Aether</span></div></div>
                            <div class="col-md-3"><div class="stat achievements">? <span>Achievements</span></div></div>
                        </div>
                    </section>

                    <div class="panel panel-dark">
                        <div class="panel-heading">User Details</div>
                        <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="text-center">
                                        <div class="process-markdown">{{ $user->signature }}</div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    @if($user->twitter)
                                        <i class="fa fa-twitter"></i> <a href="https://twitter.com/{{$user->twitter}}" target="_blank">{{ $user->twitter }}</a> <br/>
                                    @endif
                                    @if($user->facebook)
                                        <i class="fa fa-facebook-official"></i> <a href="{{$user->facebook}}" target="_blank">Facebook</a><br/>
                                    @endif
                                    @if($user->steam)
                                        <i class="fa fa-steam-square"></i> <a href="http://steamcommunity.com/id/{{$user->steam}}/" target="_blank"> {{ $user->steam }}</a><br/>
                                    @endif
                                </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-highlight">
                        <div class="panel-heading">Class Levels</div>
                        <div class="panel-body">
                            @foreach($user->jobs as $job)
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="{{ $job['icon'] }}" />
                                    </div>
                                    <div class="col-md-1">
                                        <div class="job-level">
                                            {{ $job['level'] }}
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="job-name @if($job['level'] == 60) capped @endif">
                                            {{ $job['name'] }}
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <div class="exp">
                                                    <span>{{ $job['exp_current'] }}</span> / {{ $job['exp_level'] }}
                                                </div>
                                                <div class="progress">
                                                  <div class="progress-bar @if($job['level'] == 60) capped @endif" role="progressbar" aria-valuenow="{{ $job['percent'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $job['percent'] }}%;">
                                                    <span class="sr-only">{{ $job['percent']}}% Complete</span>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 text-right">
                                                <div class="percent">
                                                    {{ $job['percent'] }}%
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@stop
