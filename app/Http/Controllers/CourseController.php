<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\Sub_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
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

    public function create(Request $request)
    {
        try {
            $categories = Category::all();
            $subCategories = $request->has('category_id') ? Sub_Category::where('category_id', $request->category_id)->get() : [];
            return view('admin.course.create_new_course', compact('categories', 'subCategories'));
        } catch (\Exception $e) {
            Log::error('Error loading course creation page', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to load course creation page.');
        }
    }

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
                'learn_in_course' => 'required',
                'requirement' => 'required',
                'course_level' => 'required',
            ]);

            Log::info('Validated request data', ['data' => $validated]);

            $course = Course::create(array_merge($validated, ['user_id' => auth()->id(), 'is_active' => 1]));
            Log::info('Course created successfully', ['course_id' => $course->id]);

            return redirect()->route('course.edit', $course->id)->with('success', 'Course inserted successfully');
        } catch (\Exception $e) {
            Log::error('Error inserting course', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred while inserting the course.');
        }
    }

    public function edit($id)
    {
        try {
            $course = Course::findOrFail($id);
            $categories = Category::all();
            $subcategories = Sub_Category::all();
            return view('admin.course.create_new_course', compact('course', 'categories', 'subcategories'));
        } catch (\Exception $e) {
            Log::error('Error loading course edit page', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to load course edit page.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $course = Course::findOrFail($id);
            $validated = $request->validate([
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
            $course->update($validated);
            Log::info('Course updated successfully', ['course_id' => $id]);
            return redirect()->back()->with('success', 'Course updated successfully');
        } catch (\Exception $e) {
            Log::error('Error updating course', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to update course.');
        }
    }

    public function destroy(Course $course)
    {
        try {
            $course->delete();
            Log::info('Course deleted successfully', ['course_id' => $course->id]);
            return redirect()->back()->with('success', 'Course deleted successfully');
        } catch (\Exception $e) {
            Log::error('Error deleting course', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Failed to delete course.');
        }
    }
}