<?php

namespace App\Http\Controllers;

use App\Models\video;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class VideoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $videos = Video::select(['id', 'video_title', 'description', 'thumbnail_url', 'video_url', 'created_at']);
            return DataTables::of($videos)
                ->addColumn('thumbnail_url', function ($video) {
                    return '<img src="/courseThumbnail/' . $video->thumbnail_url . '" alt="Thumbnail" style="width:50px; height:50px; border-radius:8px;">';
                })
                ->addColumn('video_url', function ($video) {
                    return '<video width="100" height="50" controls>
                                <source src="/courseVideo/' . $video->video_url . '" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>';
                })
                ->rawColumns(['thumbnail_url', 'video_url'])
                ->make(true);
        }
    }

    public function create()
    {
        return view('admin.course.media');
    }

    public function store(Request $request)
    {

        // Validate the request
        $request->validate([
            'video_title' => 'required|string|max:255',
            'video_discription' => 'required|string',
            'playlist_video' => 'required|file|mimes:mp4|max:20480', // Max size 20MB
            'playlist_thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048', // Max size 2MB
        ]);


        // // Store the video
        // $videoPath = $request->file('playlist_video')->store('videos', 'public');
        // $thumbnailPath = $request->file('playlist_thumbnail')->store('thumbnails', 'public');

        if ($request->hasFile('playlist_video')) {
            $videoUrl = $request->file('playlist_video');
            $videoPath = time() . '.' . $videoUrl->getClientOriginalExtension();
            $videoUrl->move(public_path('/courseVideo/'), $videoPath);
        } else {
            $videoUrlName = null;
        }

        if ($request->hasFile('playlist_thumbnail')) {
            $videoThumbnail = $request->file('playlist_thumbnail');
            $thumbnailPath = time() . '.' . $videoThumbnail->getClientOriginalExtension();
            $videoThumbnail->move(public_path('/courseThumbnail/'), $thumbnailPath);
        } else {
            $videoThumbnailName = null;
        }

        // Create a new video record
        $video = new Video();
        $video->user_id = auth()->id(); // Assuming the user is authenticated
        $video->course_id = $request->course_id; // Assuming you have a course_id field
        $video->video_title = $request->video_title;
        $video->description = $request->video_discription;
        $video->video_url = $videoPath;
        $video->thumbnail_url = $thumbnailPath;
        $video->save();

        return response()->json(['success' => 'Video uploaded successfully!']);
    }

    public function show(video $video)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, video $video)
    {
        //
    }



}