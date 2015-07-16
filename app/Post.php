<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ThreadView;

class Post extends Model
{

    // Virtual fields
    protected $appends = array('reply_count', 'view_count', 'latest_reply');

    public function getReplyCountAttribute() {
        return Post::where('thread_id', $this->id)->count();
    }

    public function getViewCountAttribute() {
        return ThreadView::where('post_id', $this->id)->count();
    }

    public function getLatestReplyAttribute() {
        return Post::with('User')->where('thread_id', $this->id)->orderBy('created_at', 'DESC')->take(1)->first();
    }

    // RELATIONSHIPS

    public function thread() {
        return $this->belongsTo('App\Post', 'id', 'thread_id');
    }

    public function replies() {
        return $this->hasMany('App\Post', 'thread_id', 'id');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function forum() {
        return $this->belongsTo('App\Forum');
    }


    // QUERY SCOPES

    public function scopeTopic($query) {
        return $query->whereNull('thread_id');
    }

    public function scopeReply($query) {
        return $query->where('thread_id', '<>', '');
    }

    public function scopeByUser($query, $user) {
        return $query->where('user_id', $user);
    }

    public function scopeByForum($query, $forum) {
        return $query->where('forum_id', $forum);
    }

}
