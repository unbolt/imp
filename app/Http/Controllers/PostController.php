<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use Carbon;
use App\Role;
use App\Permission;
use App\Forum;
use App\Post;
use App\ThreadView;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function store(Request $request) {
        // Create a new post
        $post = New Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->forum_id = $request->forum_id;
        $post->user_id = Auth::user()->id;
        $post->reply_on = Carbon::now();

        // Check if this is in response to another Thread
        if($request->thread_id) {
            $post->thread_id = $request->thread_id;
        } else {
            // It's a new post, so add a slug for it
            $post->slug = str_slug($request->title, '-');
        }

        if($post->save()) {
            // Post is made

            // Update users posts count
            $user = Auth::user();
            $user->increment('post_count');
            $user->save();

            // Update the thread if required
            if($request->thread_id) {
                $thread = Post::find($request->thread_id);
                $thread->timestamps = false;
                $thread->reply_on = Carbon::now();
                $thread->save();
            }

            // Update the forum post count
            /*
            $forum = Forum::find($post->forum_id);

            if($post->thread_id) {
                // This is in reply to another post, update the post count
                $forum->increment('reply_count');
            } else {
                // This is a fresh post, update topic count
                $forum->increment('post_count');
            }

            $forum->save();
            */

            Session::flash('alert-success', 'Post made!');
        } else {
            Session::flash('alert-error', 'Could not create post.');
        }

        if($post->slug) {
            // New post, send them to it
            return redirect('/thread/'.$post->id.'/'.$post->slug);
        } else {
            // Reply to post, send them back to it
            return back();
        }
    }

    public function show($id, $slug) {
        // Show a thread
        $post = Post::find($id);

        // Add a view to this thread
        $view = New ThreadView;
        $view->user_id = Auth::user()->id;
        $view->post_id = $id;
        $view->save();

        return view('forums.thread')->withThread($post);
    }
}
