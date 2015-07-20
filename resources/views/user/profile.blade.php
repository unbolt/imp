@extends('layouts.master')

@section('title', 'Profile')
@section('body_class', 'blurbg')

@section('content')
    @include('partials.user.header', ['user' => $user])

    <div class="container">

    </div>
@stop
