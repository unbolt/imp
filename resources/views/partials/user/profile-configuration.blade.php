<div class="panel-group" id="profileAccordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="profileHeadingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#profileAccordion" href="#profileOne" aria-expanded="true" aria-controls="profileOne">
          Character
        </a>
      </h4>
    </div>
    <div id="profileOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="profileOne">
      <div class="panel-body">
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
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="profileHeadingTwo">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#profileAccordion" href="#profileTwo" aria-expanded="false" aria-controls="profileTwo">
          Signature
        </a>
      </h4>
    </div>
    <div id="profileTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="profileTwo">
      <div class="panel-body">
          <div class="dashboard-form">
              <form method="POST" action="/dashboard/signature">
                  {!! csrf_field() !!}

                  <div>
                      <textarea id="thread-content" name="signature" class="form-control post-content-textarea" tabindex="2">{{ $user->signature }}</textarea>
                  </div>

                  <div>
                      <button id="submit" type="submit" class="btn btn-primary">Update Signature</button>
                  </div>
              </form>
          </div>
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="profileHeadingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#profileAccordion" href="#profileThree" aria-expanded="false" aria-controls="profileThree">
          Social Media
        </a>
      </h4>
    </div>
    <div id="profileThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="profileThree">
      <div class="panel-body">
          <div class="dashboard-form">
              <form method="POST" action="/dashboard/socialmedia">
                  {!! csrf_field() !!}

                  <div>
                      <input type="text" name="twitter" value="{{ $user->twitter }}" placeholder="Twitter Handle" class="form-control" tabindex="1" autocomplete="off" autocorrect="off" spellcheck="false">
                  </div>

                  <div>
                      <input type="text" name="facebook" value="{{ $user->facebook }}" placeholder="Facebook" class="form-control" tabindex="1" autocomplete="off" autocorrect="off" spellcheck="false">
                  </div>

                  <div>
                      <input type="text" name="steam" value="{{ $user->steam }}" placeholder="Steam Profile " class="form-control" tabindex="1" autocomplete="off" autocorrect="off" spellcheck="false">
                  </div>

                  <div>
                      <button id="submit" type="submit" class="btn btn-primary">Update Social Media</button>
                  </div>
              </form>
          </div>
      </div>
    </div>
  </div>
</div>
