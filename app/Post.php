<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    public function thread() {
        return $this->belongsTo('App\Post', 'id', 'thread_id');
    }

    public function author() {
        return $this->belongsTo('App\User');
    }

    public function forum() {
        return $this->belongsTo('App\Forum');
    }

}
