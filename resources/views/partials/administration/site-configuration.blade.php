<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Manage Groups
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
          <h4>Current Groups</h4>

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
          <h4>Add Group</h4>

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
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Manage Users
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
          <h4>Add User to Group</h4>

              <div class="dashboard-form">
                  <form method="POST" action="/group/addtogroup">
                      {!! csrf_field() !!}

                      <div class="row">
                          <div class="col-md-6">
                              {!! Form::select('group_id', $group_array, null, array('class' => 'form-control')) !!}
                          </div>
                          <div class="col-md-6">
                              {!! Form::select('user_id', $users_array, null, array('class' => 'form-control')) !!}
                          </div>
                      </div>
                      <div>
                          <button id="submit" type="submit" class="btn btn-primary">Add User to Group</button>
                      </div>
                  </form>
              </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Manage Forums
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">

          <h4>Edit Forums</h4>

          <table class="table table-condensed">
              <tr>
                  <th>Name</th>
                  <th>Posts / Replies</th>
                  <th></th>
              </tr>
              @foreach ($forum_list as $forum)
                  <tr>
                      <td>
                          <strong>{{ $forum->name }}</strong><br />
                          {{ $forum->description }}
                      </td>
                      <td>{{ $forum->post_count }} / {{ $forum->reply_count }}</td>
                      <td></td>
                  </tr>
                  <tr>
                      <td colspan="3">
                          <div class="{{ $forum->slug }}-edit dashboard-form">
                              <form method="POST" action="/forum/update/{{ $forum->id }}">
                                  {!! csrf_field() !!}
                                  <div>
                                      <input type="text" name="name" placeholder="Forum Name" value="{{ $forum->name }}" class="form-control" tabindex="1" autocomplete="off" autocorrect="off" spellcheck="false">
                                  </div>

                                  <div>
                                      <input type="text" name="description" placeholder="Forum Description" value="{{ $forum->description }}" class="form-control" tabindex="2" autocomplete="off" autocorrect="off" spellcheck="false">
                                  </div>

                                  <div class="row">
                                        <div class="col-md-6"><input type="text" value="{{ $forum->display_order }}" name="display_order" class="form-control"></div>
                                        <div class="col-md-6"> <button id="submit" type="submit" class="btn btn-primary">Update Forum</button></div>
                                  </div>
                              </form>
                          </div>
                      </td>
                  </tr>
              @endforeach
          </table>

          <hr/>

          <h4>Create Forum</h4>

          <div class="dashboard-form">
              <form method="POST" action="/forum/create">
                  {!! csrf_field() !!}
                  <div>
                      <input type="text" name="name" placeholder="Forum Name" class="form-control" tabindex="1" autocomplete="off" autocorrect="off" spellcheck="false">
                  </div>

                  <div>
                      <input type="text" name="description" placeholder="Forum Description" class="form-control" tabindex="1" autocomplete="off" autocorrect="off" spellcheck="false">
                  </div>

                  <div>
                      <button id="submit" type="submit" class="btn btn-primary">Create Forum</button>
                  </div>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>
