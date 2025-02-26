<?php

namespace App\Http\Controllers;

use App\Models\video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'thumbnail_url' => $videoThumbnailName,
        ]);

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