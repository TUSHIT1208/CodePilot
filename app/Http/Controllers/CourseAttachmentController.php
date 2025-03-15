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
        if ($request->ajax()) {
            $attachments = courseAttachment::where('course_id', $request->course_id)
                ->select(['id', 'title', 'discription', 'thumbnail_url', 'url', 'type', 'created_at']);

            return DataTables::of($attachments)
                ->addColumn('url', function ($attachment) {
                    $documentUrl = $attachment->type === 'video'
                        ? asset('courseVideo/' . $attachment->url)
                        : asset('courseAssignments/' . $attachment->url);

                    if ($attachment->type === 'video') {
                        return '<video width="100" height="70" controls>
                            <source src="' . $documentUrl . '" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>';
                    } else {
                        return '<div style="padding: 10px; border-radius: 8px; display: flex; gap: 10px;">
                            <img src="' . asset('images/2299504.png') . '" alt="PDF" width="70" height="70">
                            <div>
                                <strong>' . $attachment->title . '</strong><br>
                                <small>' . round(filesize(public_path('courseAssignments/' . $attachment->url)) / 1024, 2) . ' KB, PDF Document</small>
                            </div>
                            <div style="margin-left: auto; display: flex; gap: 10px;" class="mt-4 ext-left">
                                <a href="' . $documentUrl . '" target="_blank" class="gray-s">
                                    <i class="uil uil-eye" style="font-size : 20px;"></i>
                                </a>
                                <a href="' . $documentUrl . '" download class="gray-s">
                                    <i class="uil uil-download-alt" style="font-size : 20px;"></i>
                                </a>
                            </div>
                        </div>';
                    }
                })
                ->addColumn('action', function ($attachment) {
                    return '<a class="gray-s deleteAttachment" data-id="' . $attachment->id . '" data-type="' . $attachment->type . '">
                            <i class="uil uil-trash"></i>
                        </a>';
                })
                ->rawColumns(['thumbnail_url', 'url', 'action'])
                ->make(true);
        }
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
            return view('admin.course.debugger_code', compact('course_detail'));
        } else if (auth()->user()->role->name === 'insructor') {
            return view('instructor.course.debugger_code', compact('course_detail'));
        } else if (auth()->user()->role->name === 'learner') {
            return view('learner.course.debugger_code', compact('course_detail'));
        }

    }

    public function track(Request $request){
        user_video_tracker::create([
            'user_id' => $request->user_id,
            'course_attachment_id' => $request->course_attachment_id,
            'time' => $request->current_time,
            'event' => $request->event,
            'created_by' => $request->created_by,            
        ]);
    }
}
