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
        if (!session()->has('course_id')) {
            return redirect()->back()->with('error', 'Course ID is missing.');
        }
        
        $courseId = session('course_id');

        if ($request->hasFile('introduction_video')) {
            $videoUrl = $request->file('introduction_video');
            $videoUrlName = time() . '.' . $videoUrl->getClientOriginalExtension();
            $videoUrl->move(public_path('/courseVideo/'), $videoUrlName);
        } else {
            $videoUrlName = null;
        }

        if ($request->hasFile('introduction_thumbnail')) {
            $videoThumbnail = $request->file('introduction_thumbnail');
            $videoThumbnailName = time() . '.' . $videoThumbnail->getClientOriginalExtension();
            $videoThumbnail->move(public_path('/courseThumbnail/'), $videoThumbnailName);
        } else {
            $videoThumbnailName = null;
        }

        courseAttachment::create([
            'course_id' => $courseId,
            'type' => 'video',
            'url' => $request->introduction_video,
            'thumbnail_url' => $request->introduction_thumbnail,
        ]);

        $Thumbnail = null;
        if ($request->hasFile('video_thumbnail')) {
            $Thumbnail = $request->file('video_thumbnail');
            $videoThumbnailName = time() . '.' . $Thumbnail->getClientOriginalExtension();
            $Thumbnail->move(public_path('/courseThumbnail/'), $videoThumbnailName);
        } else {
            $videoThumbnailName = null;
        }

        $video = Video::create([
            'admin_id' => Auth::user()->id,
            'course_id' => $courseId,
            'video_title' => $request->video_title,
            'description' => $request->video_discription,
            'video_url' => $request->video_url,
            'thumbnail_url' => $request->video_thumbnail,
        ]);

        $video = video_code::create([
            'video_id' => $video->id, 
            'code_title' => $request->code_title, 
            'code_text' => $request->code,
        ]);

        session()->put('video_id', $video->id);

        return redirect()->back()->with('success_vid','course inserted successfully');
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
