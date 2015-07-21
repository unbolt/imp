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
                <div class="col-md-4">
                    Some text and shtuff
                </div>
                <div class="col-md-4">
                    Recent posts by user
                </div>
                <div class="col-md-4">
                    Screenshots!
                </div>
            </div>
        </section>
    </div>
@stop
