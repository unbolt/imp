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
                        <!-- TO DO: Hide this behind entrust -->
                        <a href="#site-config" clas="icon icon-site-config" aria-controls="site-config" role="tab" data-toggle="tab">site config</a>
                        <!-- End TO DO -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <h3>Welcome back!</h3>
                            <hr/>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="character-config">
                            <h3>Character Configuration</h3>
                            <hr/>
                            <p>Add your character so people know who you are!</p>

                            <div class="dashboard-form">
                                <form method="POST" action="/dashboard/character">
                                    {!! csrf_field() !!}
                                    <div>
                                        <input type="text" name="character_name" value="{{ $user->character_name }}" placeholder="Character Name" class="form-control" tabindex="1" autocomplete="off" autocorrect="off" spellcheck="false">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 text-right">
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::select('primary_job', $job_list, $user->primary_job, array('class' => 'form-control')) !!}
                                        </div>
                                    </div>

                                    <div>
                                        <button id="submit" type="submit" class="btn btn-primary">Update Character Details</button>
                                    </div>
                                </form>
                            </div>


                        </div>
                        <div role="tabpanel" class="tab-pane" id="account-config">
                            <h3>Account Configuration</h3>
                            <hr/>
                        </div>

                        <!-- TO DO: Hide this behind entrust -->
                        <div role="tabpanel" class="tab-pane" id="site-config">
                            <h3>Site Configuration</h3>

                            <hr/>

                            <h4>Manage Groups</h4>

                            <!-- Get list of groups -->
                            <h5>Current Groups</h5>

                            <table class="table table-condensed">
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Members</th>
                                </tr>
                                @foreach ($group_list as $group)
                                    <tr>
                                        <td>{{ $group->display_name }}</td>
                                        <td>{{ $group->description }}</td>
                                        <td>#</td>
                                    </tr>
                                @endforeach
                            </table>

                            <!-- Add a new group -->
                            <h5>Add Group</h5>

                                <div class="dashboard-form">
                                    <form method="POST" action="/group/create">
                                        {!! csrf_field() !!}
                                        <div>
                                            <input type="text" name="group_name" placeholder="Group Name" class="form-control" tabindex="1" autocomplete="off" autocorrect="off" spellcheck="false">
                                        </div>

                                        <div>
                                            <input type="text" name="group_description" placeholder="Group Description" class="form-control" tabindex="1" autocomplete="off" autocorrect="off" spellcheck="false">
                                        </div>

                                        <div>
                                            <button id="submit" type="submit" class="btn btn-primary">Create Group</button>
                                        </div>
                                    </form>
                                </div>

                            <!-- Add user to group -->
                            <h4>Add User to Group</h4>

                                <div class="dashboard-form">
                                    <form method="POST" action="/user/addtogroup">
                                        {!! csrf_field() !!}

                                        <div class="row">
                                            <div class="col-md-6">
                                                {!! Form::select('group_id', $group_array, null, array('class' => 'form-control')) !!}
                                            </div>
                                            <div class="col-md-6">

                                            </div>
                                        </div>
                                    </form>
                                </div>

                            <hr/>

                        </div>
                        <!-- END TO DO -->
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
