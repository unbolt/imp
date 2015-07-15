<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class UserController extends Controller
{

    /**
     *  Display the user dashboard
     *
     */

    public function dashboard()
    {

        // Get user data to display
        $user = Auth::user();

        $job_list = array(
                'paladin' => 'Paladin',
                'monk' => 'Monk',
                'warrior' => 'Warrior',
                'dragoon' => 'Dragoon',
                'bard' => 'Bard',
                'ninja' => 'Ninja',
                'white-mage' => 'White Mage',
                'black-mage' => 'Black Mage',
                'scholar' => 'Scholar',
                'summoner' => 'Summoner',
                'dark-knight' => 'Dark Knight',
                'machinist' => 'Machinist',
                'astrologian' => 'Astrologian'
            );

        return view('user.dashboard')->withUser($user)->withJobList($job_list);
    }

    // Update User's Character
    public function updateCharacter(Request $request) {

        $logged_in_user = Auth::user();

        $user = User::find($logged_in_user->id);

        if($request->character_name) {
            // Character name is set

            // Check if it has changed
            if($request->character_name != $logged_in_user->character_name) {
                $user->character_name = $request->character_name;
                if($user->save()) {
                    Session::flash('alert-success', 'Character name updated to '.$request->character_name);
                }
            }
        } else {
            // Character name isn't set, so we'll set the field to null just incase
            // Otherwise laravel sets an empty field, not a null one - annoying.
            $user->character_name = null;
            $user->character_id = null;
            if($user->save()) {
                   Session::flash('alert-success', 'Character name deleted.');
            }
        }

        if($request->primary_job) {
            if($request->primary_job != $logged_in_user->character_name) {
                $user->primary_job = $request->primary_job;
                if($user->save()) {
                    Session::flash('alert-success', 'Primary job updated.');
                }
            }
        }

        return redirect('dashboard');

    }

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
        //
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
