@extends('layouts.master')

@section('title', $thread->title)
@section('body_class', 'blurbg')

@section('content')
    <div class="container">
        <section class="forum-display">
            <div class="row">
                <div class="col-md-8">
                    <h2>Forums / {{ $thread->forum->name }}</h2>
                    <h3>{{ $thread->title }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="new_topic">
                        <h2>Reply</h2>
                        <form method="POST" action="/post/create">
                            {!! csrf_field() !!}

                            <input type="hidden" name="forum_id" value="{{ $thread->forum_id }}" />
                            <input type="hidden" name="thread_id" value="{{ $thread->id }}" />
                            <input type="hidden" name="title" value="{{ $thread->title }}" />

                            <div>
                                <textarea name="content" class="form-contronl" tabindex="2"></textarea>
                                </div>

                            <div>
                                <button id="submit" type="submit" class="btn btn-primary">Post Reply</button>
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
