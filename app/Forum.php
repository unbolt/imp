<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Forum extends Model
{
    // Virtual fields
    protected $appends = array('post_count', 'reply_count', 'latest_reply');

    public function getPostCountAttribute() {
        return Post::where('forum_id', $this->id)->topic()->count();
    }

    public function getReplyCountAttribute() {
        return Post::where('forum_id', $this->id)->reply()->count();
    }

    public function getLatestReplyAttribute() {
        return Post::with('User')->where('forum_id', $this->id)->orderBy('created_at', 'DESC')->first();
    }
}
