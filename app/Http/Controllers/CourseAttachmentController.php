<?php

namespace App\Http\Controllers;

use App\Models\course;
use App\Models\user_video_tracker;
use Illuminate\Http\Request;
use App\Models\courseAttachment;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

class CourseAttachmentController extends Controller
{
    public function index(Request $request)
    {
        //
    }

    public function getAttachments($courseId)
    {
        $attachments = CourseAttachment::where('course_id', $courseId)->get();
        
        return response()->json($attachments);
    }

    public function create()
    {
        return view('admin.course.media');
    }

    public function store(Request $request)
    {
        $request->validate([
            'video_title' => 'required|string|max:255',
            'video_discription' => 'required|string',
            'playlist_file' => 'required|file|mimes:mp4,pdf,doc,docx', // Allowing both video and assignment files
            'playlist_thumbnail' => 'required|image|mimes:jpg,jpeg,png', // Max size 2MB
            'type' => 'required|in:video,document',
        ]);

        $filePath = null;
        $thumbnailPath = null;

        if ($request->hasFile('playlist_file')) {
            $file = $request->file('playlist_file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();

            if ($request->type === 'video') {
                $file->move(public_path('/courseVideo/'), $fileName);
            } else {
                $file->move(public_path('/courseAssignments/'), $fileName);
            }
        }

        if ($request->hasFile('playlist_thumbnail')) {
            $thumbnail = $request->file('playlist_thumbnail');
            $thumbnailName = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('/courseThumbnail/'), $thumbnailName);
        }

        // Create a new course attachment record
        courseAttachment::create([
            'course_id' => $request->course_id,
            'title' => $request->video_title,
            'discription' => $request->video_discription,
            'url' => $fileName,
            'thumbnail_url' => $thumbnailName,
            'type' => $request->type,
        ]);

        return response()->json(['success' => ucfirst($request->type) . ' uploaded successfully!']);
    }

    public function show(courseAttachment $courseAttachment)
    {
        //
    }

    public function edit(courseAttachment $courseAttachment)
    {
        //
    }

    public function update(Request $request, courseAttachment $courseAttachment)
    {
        //
    }

    public function destroy($id)
    {
        $video = courseAttachment::find($id);
        if (!$video) {
            return response()->json(['error' => 'Video not found!'], 404);
        }

        // Delete files from storage (optional)
        if (File::exists(public_path('courseThumbnail/' . $video->thumbnail_url))) {
            File::delete(public_path('courseThumbnail/' . $video->thumbnail_url));
        }
        if (File::exists(public_path('courseVideo/' . $video->video_url))) {
            File::delete(public_path('courseVideo/' . $video->video_url));
        }

        $video->delete();

        return response()->json(['success' => 'Video deleted successfully!']);
    }

    public function debugger_code($id, $video_id)
    {
        $course_detail = courseAttachment::where('id', $video_id)->first();

        if (auth()->user()->role->name === 'admin') {
            return view('admin.course.mediaPlayer', compact('course_detail'));
        } else if (auth()->user()->role->name === 'insructor') {
            return view('instructor.course.mediaPlayer', compact('course_detail'));
        } else if (auth()->user()->role->name === 'learner') {
            return view('learner.course.mediaPlayer', compact('course_detail'));
        }
    }

    public function editor_media($video_id)
    {
        $course_detail = courseAttachment::where('id', $video_id)->first();
        $title = course::where('id', $course_detail->course_id)->first();
        if (auth()->user()->role->name === 'admin') {
            return view('admin.course.debugger_code', compact('course_detail', 'title'));
        } else if (auth()->user()->role->name === 'insructor') {
            return view('instructor.course.debugger_code', compact('course_detail', 'title'));
        } else if (auth()->user()->role->name === 'learner') {
            return view('learner.course.debugger_code', compact('course_detail', 'title'));
        }
    }

}
