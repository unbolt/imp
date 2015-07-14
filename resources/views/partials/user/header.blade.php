<div class="container">
    <section class="user-header">
        <div class="background" style="background-image: url('{{ $user->profile_header or '/img/profile_default.png' }}')"></div>
        <div class="row">
            <div class="col-md-2">
                <div class="user-image-full" style="background-image: url('{{ $user->character_portrait or '/img/profile_avatar_default.png' }}');"></div>
            </div>
            <div class="col-md-10">
                <div class="user-details">
                    <div class="user-name">
                        <h1>{{ $user->character_name or $user->name }}</h1>
                        <p class="user-title">{{ $user->character_title or 'Please add your character for your title to be displayed.' }}</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
