<div class="container">
    <section class="user-header">
        <div class="background" style="background-image: url('{{ $user->display_profile_header or '/img/profile_default.png' }}')"></div>
        <div class="edit-background">
            @if(Auth::user()->id == $user->id)
                <div class="upload-form">
                    <form enctype="multipart/form-data" action="/dashboard/updateheader" class="form-inline" method="POST">
                         {!! csrf_field() !!}
                         <input type="file" class="form-control" accept="image/*" name="background_image" />
                         <button type="submit" class="btn btn-default">Upload</button>
                         <span class="glyphicon glyphicon-remove hide-edit-header-icon" aria-hidden="true"></span>
                    </form>
                </div>
                <span class="glyphicon glyphicon-pencil edit-header-icon" aria-hidden="true"></span>
            @endif
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="user-image-full" style="background-image: url('{{ $user->character_portrait or '/img/profile_avatar_default.png' }}');"></div>
            </div>
            <div class="col-md-10">
                <div class="user-details">
                    <div class="user-name">
                        <h1>{{ $user->character_name or $user->name }}
                            @foreach ($user->roles as $role)
                                <div class="user-rank-icon {{ $role->name }}"></div>
                            @endforeach
                        </h1>
                        <p class="user-title">{{ $user->character_title or 'Please add your character for your title to be displayed.' }}</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
