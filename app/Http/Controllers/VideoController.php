<?php

namespace App\Http\Controllers;

use App\Models\video;
use App\Models\video_code;
use Illuminate\Http\Request;
use App\Models\courseAttachment;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('admin.course.media');
    }

    public function store(Request $request)
    {
        if ($request->hasFile('playlist_video')) {
            $videoUrl = $request->file('playlist_video');
            $videoUrlName = time() . '.' . $videoUrl->getClientOriginalExtension();
            $videoUrl->move(public_path('/courseVideo/'), $videoUrlName);
        } else {
            $videoUrlName = null;
        }

        if ($request->hasFile('playlist_thumbnail')) {
            $videoThumbnail = $request->file('playlist_thumbnail');
            $videoThumbnailName = time() . '.' . $videoThumbnail->getClientOriginalExtension();
            $videoThumbnail->move(public_path('/courseThumbnail/'), $videoThumbnailName);
        } else {
            $videoThumbnailName = null;
        }

        Video::create([
            'user_id' => Auth::user()->id,
            'course_id' => $request->course_id,
            'video_title' => $request->video_title,
            'description' => $request->video_discription,
            'video_url' => $videoUrlName,
            'thumbnail_url' =>$videoThumbnailName,
        ]);

    }

    public function show(video $video)
    {
        //
    }

    public function edit($id)
    {
        $videoId = session('video_id');

        $course_attachment = courseAttachment::with('course')->where('course_id',$id)->get();
        $video = video::with('course')->where('course_id',$id)->get();
        $video_code = video_code::with('video')->where('video_id',$videoId)->get();

        return view('admin.course.media',compact('course_attachment','video','video_code'));
    }


    public function update(Request $request, video $video)
    {
        //
    }


    public function destroy(video $video)
    {
        //
    }
}
