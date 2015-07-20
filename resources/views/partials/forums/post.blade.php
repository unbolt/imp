<div class="row post-{{ $post->id }}">
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
            <div class="row">
                <div class="col-sm-6">
                    <div class="posted-at">
                        Posted {!! Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans(); !!}
                        @if($post->user->id === Auth::user()->id)
                            &nbsp;<span class="glyphicon glyphicon-pencil edit-button" aria-hidden="true"></span>
                        @endif

                        @if($post->created_at != $post->updated_at)
                            &nbsp;<em>&laquo; Last Edited {!! Carbon::createFromTimeStamp(strtotime($post->updated_at))->diffForHumans(); !!} &raquo;</em>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6 text-right">
                </div>
            </div>

            <div class="process-markdown post-content-main post-content-{{ $post->id }}">{{ $post->content }}</div>
            @if($post->user->id === Auth::user()->id)
                <div class="edit-post edit-post-{{ $post->id }}">
                    <div class="forum-form">
                        <form id="edit-post-{{ $post->id }}" class="edit-post">
                            {!! csrf_field() !!}

                            <input type="hidden" name="post_id" value="{{ $post->id }}" />

                            <div>
                                <textarea name="content" class="form-control post-content-textarea" tabindex="2">{{ $post->content }}</textarea>
                            </div>

                            <div>
                                <button id="submit" type="submit" class="btn btn-primary">Edit Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            <hr/>

            <div class="signature">
                <div class="process-markdown">{{ $post->user->signature }}</div>
            </div>
        </div>
    </div>
</div>
<hr />
