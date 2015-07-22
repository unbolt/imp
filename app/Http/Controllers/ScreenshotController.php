<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use App\Screenshot;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ScreenshotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Grab the latest 12 screenshots
        $screenshots = Screenshot::with('user')->orderBy('created_at', 'DESC')->limit(12)->paginate(12);

        return view('gallery.gallery')->withScreenshots($screenshots);
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
        // Upload screenshot
        $this->validate($request, [
                'screenshot' => 'required|image'
            ]);

        $logged_in_user = Auth::user();

        if($request->file('screenshot')->isValid()) {
            // We have a file uploaded, and it's valid

            // Store the screenshot
            $screenshot = New Screenshot;
            $screenshot->user_id = $logged_in_user->id;
            $screenshot->extension = $request->file('screenshot')->guessExtension();

            if($screenshot->save()) {
                // Use ID as file name
                $filename = $screenshot->id.'.'.$request->file('screenshot')->guessExtension();

                // Move the screenshot
                if($request->file('screenshot')->move(storage_path('uploads/images'), $filename)) {
                    Session::flash('alert-success', 'Screenshot uploaded!.');
                }

            }

        }

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
