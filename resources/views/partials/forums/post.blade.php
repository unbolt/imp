<div class="row">
    <div class="col-md-2">
        <div class="post-user-info-container" style="background-image: url('{{ $post->user->character_portrait or '/img/profile_avatar_default.png' }}');">

            <div class="user-name">
                {{ $post->user->character_name or $post->user->name }}
            </div>

            <div class="user-icon">
                @if($post->user->primary_job)
                    <img src="/img/icons/{{$post->user->primary_job}}.png" />
                @endif
            </div>
            <div class="user-gil">
                {{ $post->user->post_count }}
            </div>
        </div>

    </div>
    <div class="col-md-10">
        <div class="post-content">
            <div class="posted-at">
                Posted {!! Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans(); !!}
            </div>
            <div class="process-markdown">{{ $post->content }}</div>

            <hr/>

            <div class="signature">
                <div class="process-markdown">{{ $post->user->signature }}</div>
            </div>
        </div>
    </div>
</div>
<hr />
