<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use Carbon;
use App\Role;
use App\Permission;
use App\User;
use App\Forum;
use App\Post;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Lodestone;


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

            // Have a look for any posts that mention the user
            $mention_posts = collect();

            if($user->character_name) {
                $character_name = explode(' ', $user->character_name);

                $mention_posts = Post::
                    with('thread')
                    ->with('user')
                    ->where('content', 'like', '%@'.$character_name[0].'%')
                    ->orWhere('content', 'like', '%@'.$character_name[0].$character_name[1].'%')
                    ->orderBy('created_at', 'DESC')
                    ->limit(5)
                    ->get();
            }

            // Get the latest topics

            // Get the users permissions
            GLOBAL $canAccess;
            $canAccess = $user->getPermissions();

            // Filter the canAccess array to get the list of forum IDs the user can access
            $accessCollection = collect();
            foreach($canAccess as $hasAccess) {
                if (strpos($hasAccess, 'access-forum-') !== false) {
                    $access = explode('-', $hasAccess);
                    if($access[2]) {
                        $accessCollection->push($access[2]);
                    }
                }
            }

            $latest_posts = Post::
                with('thread')
                ->with('user')
                ->whereIn('forum_id', $accessCollection)
                ->orderBy('created_at', 'DESC')
                ->limit(7)
                ->get();



        if($user->hasRole('administrators')) {

            $group_list = Role::all();

            $group_array = array();
            foreach($group_list as $group) {
                $group_array[$group->id] = $group->display_name;
            }

            $permission_list = Permission::all();

            $permission_array = array();
            foreach($permission_list as $permission) {
                $permission_array[$permission->id] = $permission->display_name;
            }

            $users_list = User::all();

            $users_array = array();
            foreach($users_list as $users) {
                $users_array[$users->id] = $users->character_name ? $users->character_name : $users->name;
            }

            $forums_list = Forum::orderBy('display_order', 'asc')->get();

            return view('user.dashboard')
                ->withUser($user)
                ->withMentionPosts($mention_posts)
                ->withLatestPosts($latest_posts)
                ->withJobList($job_list)
                ->withGroupList($group_list)
                ->withGroupArray($group_array)
                ->withPermissionArray($permission_array)
                ->withUsersArray($users_array)
                ->withForumList($forums_list);

        } else {
            return view('user.dashboard')
                    ->withUser($user)
                    ->withJobList($job_list)
                    ->withMentionPosts($mention_posts)
                    ->withLatestPosts($latest_posts);
        }
    }

    // Update User's Character
    public function updateCharacter(Request $request) {

        $logged_in_user = Auth::user();

        $user = User::find($logged_in_user->id);

        if($request->character_name) {
            // Character name is set

            // Check if it has changed
            if($request->character_name != $logged_in_user->character_name) {

                // Check it's unique
                $this->validate($request, [
                    'character_name' => 'unique:users,character_name,'.$logged_in_user->id
                ]);

                $user->character_name = $request->character_name;

                $lodestone = New Lodestone;

        		$character = $lodestone->Search->Character($request->character_name, 'Moogle');

                if(isset($character->id)) {
                    $user->character_id = $character->id;

                    if($user->save()) {
                        Session::flash('alert-success', 'Character name updated to '.$request->character_name);
                    }
                } else {
                    Session::flash('alert-error', 'Could not find character '.$request->character_name);
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

    // Update signature
    public function updateSignature(Request $request) {
        $logged_in_user = Auth::user();
        $user = User::find($logged_in_user->id);
        $user->signature = $request->signature;
        if($user->save()) {
            Session::flash('alert-success', 'Signature updated.');
        } else {
            Session::flash('alert-warning', 'Could not update signature.');
        }

        return back();

    }

    // Update header
    public function updateHeader(Request $request) {

        $this->validate($request, [
                'background_image' => 'required|image'
            ]);

        $logged_in_user = Auth::user();

        if($request->file('background_image')->isValid()) {
            // We have a file uploaded, and it's valid
            // Generate a name for it
            $filename = $logged_in_user->id.'-header.'.$request->file('background_image')->guessExtension();
            $directory = 'headers/';

            if($request->file('background_image')->move($directory, $filename)) {
                // Update the users profile image
                $logged_in_user->profile_header = $filename.'?'.time();
                if($logged_in_user->save()) {
                    Session::flash('alert-success', 'Header updated.');
                } else {
                    Session::flash('alert-warning', 'Could not save header.');
                }
            } else {
                Session::flash('alert-warning', 'Could not upload header.');
            }
        } else {
            Session::flash('alert-warning', 'Header was not valid.');
        }

        return back();
    }

    // Update online status
    public function updateOnline(Request $request) {
        $logged_in_user = Auth::user();

        if($logged_in_user) {
            $logged_in_user->active_at = Carbon::now();
            $logged_in_user->save();
        }

        return response()->json(['success' => 'true'], 200);
    }

    // Query the username and return the details
    public function queryUsername($username) {
        // Check if we have a first name only, or if we have a FirstLast
        $check_username = preg_split('/(?=[A-Z])/',$username);

        if(isset($check_username[2])) {
            // We have a surname
            $format_charname = $check_username[1] . ' ' . $check_username[2];
            $get_user = User::where('character_name', '=', $check_username[1].' '.$check_username[2])->select('id', 'name', 'character_name')->first();
        } else {
            $get_user = User::where('character_name', 'like', $username.'%')->select('id', 'name', 'character_name')->first();
        }

        return response()->json(['user' => $get_user], 200);
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
        // Show a users profile page
        $user = User::find($id);

        return view('user.profile')->withUser($user);
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
