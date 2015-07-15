<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use App\Role;
use App\Permission;
use App\Forum;
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
        //
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
        $forum->post_count = '0';
        $forum->reply_count = '0';

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
    public function show($id)
    {
        //
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
        //
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
