@extends('layouts.master')

@section('title', 'Register Account')
@section('body_class', 'blurbg')

@section('content')

<div class="container register">
    <div class="row col-md-4 col-md-offset-4">
        <div class="logo_full"></div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <form method="POST" action="/register">
                {!! csrf_field() !!}

                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Username" class="form-control" tabindex="1" autocomplete="off" autocorrect="off" spellcheck="false">

                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control" tabindex="1" autocomplete="off" autocorrect="off" spellcheck="false">

                    <input type="password" name="password" id="password" placeholder="Password" class="form-control" tabindex="2" autocomplete="off" autocorrect="off" spellcheck="false">

                    <input type="password" name="password_confirmation" id="password" placeholder="Confirm Password" class="form-control" tabindex="2" autocomplete="off" autocorrect="off" spellcheck="false">


                    <div>
                    <button id="submit" type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
