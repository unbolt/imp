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
        </section>
    </div>
@stop
