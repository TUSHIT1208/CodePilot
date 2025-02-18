<?php

namespace App\Http\Controllers;

use App\Models\course;
use App\Models\category;
use App\Models\sub_category;
use Illuminate\Http\Request;

class CourseController extends Controller
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

     public function create(Request $request)
    {
        // Get all categories
        $categories = Category::all();
        
        // If category is selected, fetch corresponding subcategories
        $subCategories = [];

        if ($request->has('category_id')) {
            $subCategories = Sub_Category::where('category_id', $request->category_id)->get();
        }

        return view('admin.course.create_new_course', compact('categories', 'subCategories'));
    }

    public function getSubCategories(Request $request)
    {
        $categoryId = $request->input('category_id');

        if ($categoryId) {
            $subCategories = Sub_Category::where('category_id', $categoryId)->get();
            return response()->json($subCategories);
        }

        return response()->json([]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:60',
            'description' => 'required|max:255',
            'course_description' => 'required',  // Assuming you need to store full description
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'course_type' => 'required|in:video,text',  // Example types, adjust to your needs
            'meta_keyword' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'learn_in_course' => 'required|string|max:255',
            'requirement' => 'required|string|max:255',
            'course_level' => 'required|string|max:255',
        ]);
        //dd($request->all()); 
    
        
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
            'published_at' => null, // Set published_at as NULL by default
            'course_type' => $request->course_type,
            'title' => $request->title,
            'description' => $request->description ?? '',
            'course_description' => $request->course_description,
            'learn_in_course' => $request->learn_in_course,
            'requirement' => $request->requirement,
            'course_level' => $request->course_level,
        ]);

    // Store the course ID in the session
        session()->put('course_id', $course->id);
        // if ($course) {
            //return response()->json(['success' => 'Subcategory status updated successfully.']);
        // }
        return redirect()->back()->with('success','course inserted successfully');
        // return redirect()->route('course.test');
        // return view('admin.course.test');
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

    // public function showCreateCourseForm()
    // {
    //     // Retrieve the course data stored in session or use a default empty object
    //     $course = session('course', (object)[]);  // Default to empty object if no session exists
        
    //     // Pass the course to the view
    //     return view('admin.course.create_new_course', compact('course'));
    // }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
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

        $course->update($request->all());

        return redirect()->back()->with('success','course updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(course $course)
    {
        //
    }
}
