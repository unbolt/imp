<div class="panel-group" id="profileAccordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="profileHeadingOne">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#profileAccordion" href="#profileOne" aria-expanded="true" aria-controls="profileOne">
          Character Configuration
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
          Signature Configuration
        </a>
      </h4>
    </div>
    <div id="profileTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="profileTwo">
      <div class="panel-body">

      </div>
    </div>
  </div>
</div>
