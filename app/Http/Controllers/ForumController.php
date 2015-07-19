<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use App\Role;
use App\Permission;
use App\Forum;
use App\Post;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Display the forum index

        // Get the users permissions
        GLOBAL $canAccess;
        $canAccess = Auth::user()->getPermissions();

        // Get the list of forums the user has access to
        $forums = Forum::all();

        $filteredForums = $forums->filter(function ($item) {
            $forum_permission = 'access-forum-'.$item->id;

            if(in_array($forum_permission, $GLOBALS['canAccess'])) {
                return $item;
            }
        });

        return view('forums.forum')->withForums($filteredForums);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Validate the forum
        $this->validate($request, [
            'name' => 'required|unique:forums|max:255',
            'description' => 'required'
        ]);

        // Create a new Forum
        $forum = New Forum;
        $forum->name = $request->name;
        $forum->slug = str_slug($request->name, '-');
        $forum->description = $request->description;

        if($forum->save()) {
            // Grant the admin access to the forum
            $admin = Role::find(1); // Admin should be created when built, shouldn't be an issue

            $accessForum = new Permission();

            $accessForum->name = 'access-forum-'.$forum->id;
            $accessForum->display_name = 'Access '.$forum->name; // optional
            $accessForum->description  = 'Ability to access and post in '.$forum->name; // optional
            $accessForum->save();

            $admin->attachPermission($accessForum);

            Session::flash('alert-success', 'Forum created.');

        } else {
            Session::flash('alert-error', 'Could not create forum.');
        }

        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {
        // Get the threads for a specific forum and return the view
        // Get the users permissions
        GLOBAL $canAccess;
        $canAccess = Auth::user()->getPermissions();

        // Get the forum details
        $forum = Forum::where('slug', $slug)->first();

        /*
        $filteredForums = $forums->filter(function ($item) {
            $forum_permission = 'access-forum-'.$item->id;

            if(in_array($forum_permission, $GLOBALS['canAccess'])) {
                return $item;
            }
        });
        */

        // Get the threads in the forum
        $threads = Post::with('user')
                        ->Topic()
                        ->ByForum($forum->id)
                        ->orderBy('announcement', 'DESC')
                        ->orderBy('sticky', 'DESC')
                        ->orderBy('reply_on', 'DESC')
                        ->paginate(15);

        return view('forums.threadlist')->withForum($forum)->withThreads($threads);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $forum = Forum::find($id);

        $this->validate($request, [
            'name' => 'required|unique:forums,name,'.$forum->id.'|max:255',
            'description' => 'required'
        ]);

        // Update forum
        $forum->name = $request->name;
        $forum->slug = str_slug($request->name, '-');
        $forum->description = $request->description;
        $forum->display_order = $request->display_order;

        if($forum->save()) {
            Session::flash('alert-success', 'Forum updated.');
        }

        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
