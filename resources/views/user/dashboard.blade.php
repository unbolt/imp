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

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <h3>Welcome back!</h3>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="character-config">
                            <h3>Character Configuration</h3>

                            <div class="dashboard-form">
                                <form method="POST" action="/dashboard/character">
                                    {!! csrf_field() !!}
                                    <div>
                                        <input type="text" name="character_name" value="{{ $user->character_name }}" placeholder="Character Name" class="form-control" tabindex="1" autocomplete="off" autocorrect="off" spellcheck="false">
                                    </div>

                                    <div>
                                        <button id="submit" type="submit" class="btn btn-primary">Update Character Details</button>
                                    </div>
                                </form>
                            </div>


                        </div>
                        <div role="tabpanel" class="tab-pane" id="account-config">
                            <h3>Account Configuration</h3>
                        </div>
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
