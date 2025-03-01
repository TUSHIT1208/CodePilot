<?php

namespace App\Http\Controllers;

use App\Models\course;
use App\Models\category;
use App\Models\sub_category;
use Illuminate\Http\Request;
use App\Models\courseAttachment;
use Illuminate\Support\Facades\Log;
use App\Models\video;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $courses = Course::with(['courseattachment', 'user'])->where('user_id', auth()->id())->get();
            //return $courses;
            Log::info('Fetched courses successfully', ['courses_count' => $courses->count()]);
            if (auth()->user()->role->name == 'admin') {
                return view('admin.course.list', compact('courses'));
            } else if (auth()->user()->role->name == 'insructor') {
                return view('instructor.course.list', compact('courses'));
            }

        } catch (\Exception $e) {
            Log::error('Error fetching courses', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Failed to load courses.');
        }
    }


    /**
     * Show the form for creating a new resource.
     */

    public function create(Request $request)
    {
        try {
            // Get all categories
            $categories = Category::all();

            // If category is selected, fetch corresponding subcategories
            $subCategories = [];

            if ($request->has('category_id')) {
                $subCategories = Sub_Category::where('category_id', $request->category_id)->get();
            }
            if (auth()->user()->role->name == 'admin') {
                return view('admin.course.create_new_course', compact('categories', 'subCategories'));
            } else if (auth()->user()->role->name == 'insructor') {
                return view('instructor.course.create_new_course', compact('categories', 'subCategories'));
            }
        } catch (\Exception $e) {
            Log::error('Error fetching courses', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'Failed to load courses.');
        }
    }

    public function getSubCategories(Request $request)
    {
        try {
            $categoryId = $request->input('category_id');

            if ($categoryId) {
                $subCategories = Sub_Category::where('category_id', $categoryId)->get();
                return response()->json($subCategories);
            }

            return response()->json([]);
        } catch (\Exception $e) {
            Log::error('Error inserting course', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'An error occurred while inserting the course.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ini_set('memory_limit', '12G'); // Increase memory limit
        try {

            $validated = $request->validate([
                'title' => 'required|max:60',
                'description' => 'required',
                'course_description' => 'required',
                'category_id' => 'required|exists:categories,id',
                'sub_category_id' => 'required|exists:sub_categories,id',
                'course_type' => 'required|in:video,text',
                'meta_keyword' => 'required|string|max:255',
                'meta_title' => 'required|string|max:255',
                'meta_description' => 'required',
                'learn_in_course' => 'required',
                'requirement' => 'required',
                'course_level' => 'required',
                'introduction_thumbnail' => 'required|file|mimes:jpg,jpeg,png',
                'introduction_video' => 'required|file|mimes:mp4',
            ]);

            Log::info('Validated request data', ['data' => $validated]);

            $course = Course::create([
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'meta_keyword' => $request->meta_keyword ?? '',
                'meta_title' => $request->meta_title ?? '',
                'meta_description' => $request->meta_description ?? '',
                'price' => $request->price ?? 0,
                'discount' => $request->discount ?? null,
                'is_active' => 1,
                'published_at' => null,
                'course_type' => $request->course_type,
                'title' => $request->title,
                'description' => $request->description ?? '',
                'course_description' => $request->course_description,
                'learn_in_course' => $request->learn_in_course,
                'requirement' => $request->requirement,
                'course_level' => $request->course_level,

            ]);

            Log::info('Course created successfully', ['course_id' => $course->id]);

            log::info($request->hasFile('introduction_video'));
            if ($request->hasFile('introduction_video')) {
                $videoUrl = $request->file('introduction_video');
                $videoUrlName = time() . '.' . $videoUrl->getClientOriginalExtension();
                log::info($videoUrlName);
                $videoUrl->move(public_path('/courseVideo/'), $videoUrlName);
            } else {
                $videoUrlName = null;
            }
            log::info($videoUrlName);
            if ($request->hasFile('introduction_thumbnail')) {
                $videoThumbnail = $request->file('introduction_thumbnail');
                $videoThumbnailName = time() . '.' . $videoThumbnail->getClientOriginalExtension();
                log::info($videoThumbnailName);
                $videoThumbnail->move(public_path('/courseThumbnail/'), $videoThumbnailName);
            } else {
                $videoThumbnailName = null;
            }
            log::info($videoThumbnailName);
            courseAttachment::create([
                'course_id' => $course->id,
                'type' => 'video',
                'url' => $videoUrlName,
                'thumbnail_url' => $videoThumbnailName,
            ]);

            Log::info('Course created successfully', ['course_id' => $course->id]);

            return redirect()->route('course.edit', $course->id)->with('success', 'Course inserted successfully');

        } catch (\Exception $e) {
            Log::error('Error inserting course', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'An error occurred while inserting the course.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $courseDetail = Course::with(['category', 'subcategory'])->where('id', $id)->first();
        $courseAttachment = courseAttachment::with('course')->where('course_id', $id)->first();
        $video = video::with('course')->where('course_id', $id)->get();
        // return $video;
        if (auth()->user()->role->name == 'admin') {
            return view('admin.course.each_course', compact('courseDetail', 'courseAttachment', 'video'));
        } else if (auth()->user()->role->name == 'insructor') {
            return view('instructor.course.each_course', compact('courseDetail', 'courseAttachment', 'video'));

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $course = Course::with('courseattachment')->findOrFail($id); // Load course with attachments
        //return $course;
        $categories = Category::all(); // Fetch all categories
        $subcategories = Sub_category::all(); // Fetch all subcategories (if needed)
        if (auth()->user()->role->name == 'admin') {
            return view('admin.course.create_new_course', compact('course', 'categories', 'subcategories'));
        } else if (auth()->user()->role->name == 'insructor') {
            return view('instructor.course.create_new_course', compact('course', 'categories', 'subcategories'));

        }
    }

    public function update(Request $request, Course $course)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|min:3|max:255',
                'description' => 'required|string|min:10|max:1000',
                'course_description' => 'required|string',
                'learn_in_course' => 'required|string|min:10|max:1000',
                'requirement' => 'required|string|min:10|max:1000',
                'course_level' => 'required|string|in:Beginner,Intermediate,Expert',
                'course_type' => 'required|string|in:text,video',
                'category_id' => 'required|exists:categories,id',
                'sub_category_id' => 'required|exists:sub_categories,id',
                'meta_keyword' => 'required|string|min:3|max:255',
                'meta_title' => 'required|string|min:3|max:255',
                'meta_description' => 'required|string|min:10|max:1000',

            ]);
            Log::info('Validated request data', ['data' => $validated]);
            // ✅ Update course details
            $course->update($request->only([
                'title',
                'description',
                'course_description',
                'learn_in_course',
                'requirement',
                'course_level',
                'course_type',
                'category_id',
                'sub_category_id',
                'meta_keyword',
                'meta_title',
                'meta_description'
            ]));

            // ✅ Handle Video Upload
            if ($request->hasFile('introduction_video')) {
                $video = $request->file('introduction_video');
                $videoName = time() . '_' . $video->getClientOriginalName();
                $video->move(public_path('courseVideo'), $videoName);

                $course->courseattachment()->updateOrCreate(
                    ['course_id' => $course->id],
                    ['url' => $videoName]
                );
            }

            // ✅ Handle Thumbnail Upload
            if ($request->hasFile('introduction_thumbnail')) {
                $thumbnail = $request->file('introduction_thumbnail');
                $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
                $thumbnail->move(public_path('courseThumbnail'), $thumbnailName);

                $course->courseattachment()->updateOrCreate(
                    ['course_id' => $course->id],
                    ['thumbnail_url' => $thumbnailName]
                );
            }



            return redirect()->back()->with('success', 'course updated successfully');
        } catch (\Exception $e) {
            Log::error('Error inserting course', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'An error occurred while updateing the course.');
        }
    }

    public function price(Request $request, Course $course)
    {
        $request->validate([
            'price' => 'required|numeric|min:0|max:99999999.99', // Ensures price is within valid decimal(10,2) range
            'discount' => 'required|numeric|min:0|max:99999999.99|lte:price', // Ensures discount is valid and less than or equal to price
        ]);

        $course->update([
            'price' => $request->price,
            'discount' => $request->discount,
        ]);

        return response()->json(['success' => true, 'message' => 'Price updated successfully']);
    }
    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id)
    // {
    //     try{
    //     $course = Course::findOrFail($id);

    //     $validated =$request->validate([
    //         'title' => 'required|string|max:100|unique:courses,title,' . $id,
    //         'description' => 'required|string',
    //         'course_description' => 'required|string',
    //         'learn_in_course' => 'required|string',
    //         'requirement' => 'required|string',
    //         'course_level' => 'required|in:Beginner,Intermediate,Expert',
    //         'course_type' => 'required|in:text,video',
    //         'category_id' => 'required|exists:categories,id',
    //         'sub_category_id' => 'required|exists:sub_categories,id'

    //     ]);
    //     Log::info('Validated request data', ['data' => $validated]);
    //     $course->update($request->all());

    //     if ($request->hasFile('introduction_video')) {
    //         $videoFile = $request->file('introduction_video');
    //         $videoPath = time() . '.' . $videoFile->getClientOriginalExtension();
    //         $videoFile->move(public_path('/courseVideo/'), $videoPath);
    //     } else {
    //         $videoPath = $course->courseattachment->url ?? null; // Keep existing if not updated
    //     }
    //     logger($videoPath);
    //     // Handle thumbnail file upload if provided
    //     if ($request->hasFile('introduction_thumbnail')) {
    //         $thumbnailFile = $request->file('introduction_thumbnail');
    //         $thumbnailPath = time() . '.' . $thumbnailFile->getClientOriginalExtension();
    //         $thumbnailFile->move(public_path('/courseThumbnail/'), $thumbnailPath);
    //     } else {
    //         $thumbnailPath = $course->courseattachment->thumbnail_url ?? null;
    //     }

    //     // Update or create course attachment
    //     $attachment = courseAttachment::where('course_id', $course->id)->first();

    //     if ($attachment) {
    //         $attachment->update([
    //             'type' => 'video',
    //             'url' => $videoPath,
    //             'thumbnail_url' => $thumbnailPath,
    //         ]);
    //     }

    //     return redirect()->back()->with('success','course updated successfully');
    //     }catch (\Exception $e) {
    //             Log::error('Error inserting course', [
    //                 'message' => $e->getMessage(),
    //                 'line' => $e->getLine(),
    //                 'file' => $e->getFile(),
    //                 'trace' => $e->getTraceAsString()
    //             ]);

    //             return redirect()->back()->with('error', 'An error occurred while updateing the course.');
    //         }
    // }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(course $course)
    {
        //
    }
}