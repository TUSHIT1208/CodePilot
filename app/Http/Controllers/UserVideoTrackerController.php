<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user_video_tracker;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserVideoTrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(user_video_tracker $user_video_tracker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user_video_tracker $user_video_tracker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user_video_tracker $user_video_tracker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user_video_tracker $user_video_tracker)
    {
        //
    }

    public function track(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_attachment_id' => 'required|exists:course_attachments,id',
            'current_time' => 'required|numeric',
            'event' => 'required|string'
        ]);

        user_video_tracker::updateOrCreate(
            [
                'user_id' => $request->user_id,
                'course_attachment_id' => $request->course_attachment_id,
            ],
            [
                'time' => (int) $request->current_time, // Store in seconds
                'event' => $request->event,
                'created_by' => $request->user_id,
            ]
        );

        return response()->json(['message' => 'Video progress saved', 'time' => $request->current_time]);
    }
}
