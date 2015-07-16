<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use App\Role;
use App\Permission;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GroupController extends Controller
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
        // Create a new group
        $role = new Role();
        $role->name = str_slug($request->group_name, '-');
        $role->display_name = $request->group_name;
        $role->description = $request->group_description;
        if($role->save()) {
            Session::flash('alert-success', 'Group Created.');
        }

        return redirect('dashboard');
    }


    // Add User to Role
    public function addUserToGroup(Request $request)
    {
       // Grab the user
        $user = User::find($request->user_id);

        if($user->attachRole($request->group_id)) {
            Session::flash('alert-success', 'User added to group.');
        } else {
            Session::flash('alert-error', 'Could not add user to group.');
        }

        return redirect('dashboard');
    }

    // Add permission to role
    public function addPermissionToGroup(Request $request)
    {
        $permission = Permission::find($request->permission_id);

        $role = Role::find($request->role_id);

        $role->attachPermission($permission);

        Session::flash('alert-success', 'Permission Granted');

        return back();
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
