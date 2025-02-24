<?php

namespace App\Http\Controllers;

use App\Models\course;
use App\Models\category;
use App\Models\sub_category;
use Illuminate\Http\Request;
use App\Models\courseAttachment;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $courses = Course::with(['courseAttachment', 'user'])->get();

            Log::info('Fetched courses successfully', ['courses_count' => $courses->count()]);

            return view('admin.course.list', compact('courses'));

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

        return view('admin.course.create_new_course', compact('categories', 'subCategories'));
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
        try{
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
                'introduction_thumbnail'=>'required',
                'introduction_video'=>'required'
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
                'thumbnail_url' => $request->thumbnail_url ?? '',
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
                'course_id' => $course->id,
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
    public function show(course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id); // Fetch course by ID
        $categories = Category::all(); // Fetch all categories
        $subcategories = Sub_category::all(); // Fetch all subcategories (if needed)

        return view('admin.course.create_new_course', compact('course', 'categories', 'subcategories'));
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
        $course = Course::findOrFail($id);

        $validated =$request->validate([
            'title' => 'required|string|max:100|unique:courses,title,' . $id,
            'description' => 'required|string',
            'course_description' => 'required|string',
            'learn_in_course' => 'required|string',
            'requirement' => 'required|string',
            'course_level' => 'required|in:Beginner,Intermediate,Expert',
            'course_type' => 'required|in:text,video',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id'
            
        ]);
        Log::info('Validated request data', ['data' => $validated]);
        $course->update($request->all());

        return redirect()->back()->with('success','course updated successfully');
     }catch (\Exception $e) {
            Log::error('Error inserting course', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->with('error', 'An error occurred while updateing the course.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(course $course)
    {
        //
    }
}
