@extends('layouts.master')

@section('title', 'Login')
@section('body_class', 'blurbg')

@section('content')

<div class="container login">
    <div class="row col-md-4 col-md-offset-4">
        <div class="logo_full"></div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <form method="POST" action="/login">
                {!! csrf_field() !!}
                <div>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control" tabindex="1" autocomplete="off" autocorrect="off" spellcheck="false">
                </div>

                <div>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control" tabindex="2" autocomplete="off" autocorrect="off" spellcheck="false">
                </div>

                <div>
                    <input type="checkbox" name="remember"> Keep me logged in
                </div>

                <div>
                    <button id="submit" type="submit" class="btn btn-primary btn-lg btn-block">Log In</button>
                </div>
                <div>
                    <a href="/register" class="btn btn-block btn-large">Register Account</a>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
