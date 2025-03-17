<?php

namespace App\Http\Controllers;

use App\Models\certificate;
use App\Models\test;
use App\Models\User;
use App\Models\user_course;
use App\Models\video;
use App\Models\course;
use App\Models\category;
use App\Models\sub_category;
use Illuminate\Http\Request;
use App\Models\courseAttachment;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;

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

            $course = Course::create([
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'meta_keyword' => $request->meta_keyword ?? '',
                'meta_title' => $request->meta_title ?? '',
                'meta_description' => $request->meta_description ?? '',
                'price' => $request->price ?? 0,
                'discount' => $request->discount ?? null,
                'is_active' => 0,
                'published_at' => null,
                'course_type' => $request->course_type,
                'title' => $request->title,
                'description' => $request->description ?? '',
                'course_description' => $request->course_description,
                'learn_in_course' => $request->learn_in_course,
                'requirement' => $request->requirement,
                'url' => $videoUrlName,
                'thumbnail_url' => $videoThumbnailName,
                'course_level' => $request->course_level,
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

    public function show($id)
    {
        $courseDetail = Course::with(['category', 'subcategory', 'courseattachment'])->where('id', $id)->first();
        $users = User::find($courseDetail->user_id);
        $cid = $courseDetail->id;
        session()->put('course', $cid);
        $userId = auth()->user()->id; // Get the authenticated user's ID
        //  $userId = 1; // Example user ID

        $checkPurchase = user_course::where('user_id', $userId)->where('course_id', $cid)->first();

        if (auth()->user()->role->name === 'admin') {
            return view('admin.course.each_course', compact('courseDetail', 'users'));
        } else if (auth()->user()->role->name === 'insructor') {
            return view('instructor.course.each_course', compact('courseDetail', 'users'));
        } else if (auth()->user()->role->name === 'learner') {
            return view('learner.course.each_course', compact('courseDetail', 'users', 'checkPurchase'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        $course = Course::findOrFail($id); // Load course with attachments
        // return $course;
        $categories = Category::all(); // Fetch all categories
        $subcategories = Sub_category::all(); // Fetch all subcategories (if needed)
        $tests = test::where('course_id', $id)->select('id')->first();

        if ($request->ajax()) {
            // Fetch tests with related course, questions, and options
            // $tests = Test::with('course', 'testquestion.testoption')
            //     ->select('id', 'test_title', 'passing_mark', 'total_marks', 'time', 'created_at');
            $test_tbl = test::with('testquestion.testoption')->get();
            return DataTables::of($test_tbl)
                ->addColumn('questions', function ($test) {
                    // Loop through test questions and include their options
                    $questions = $test->testQuestions->map(function ($question) {
                        $questionDetails = $question->question_text . ' (Score: ' . $question->score . ')';

                        // Get options for each question
                        $options = $question->testOptions->map(function ($option) {
                            return $option->option_text . ($option->is_correct ? ' (Correct)' : '');
                        });

                        // Format options below each question
                        $questionDetails .= '<br>' . implode('<br>', $options);
                        return $questionDetails;
                    });

                    return implode('<br><br>', $questions);
                })
                ->addColumn('action', function ($test) {
                    return '<a class="gray-s editTest" data-id="' . $test->id . '">
                            <i class="uil uil-edit"></i>
                        </a>
                        <a class="gray-s deleteTest" data-id="' . $test->id . '">
                            <i class="uil uil-trash"></i>
                        </a>';
                })
                ->rawColumns(['action', 'questions']) // Allow HTML formatting
                ->make(true);
        }

        if (auth()->user()->role->name == 'admin') {
            return view('admin.course.create_new_course', compact('course', 'categories', 'subcategories', 'tests'));
        } else if (auth()->user()->role->name == 'insructor') {
            return view('instructor.course.create_new_course', compact('course', 'categories', 'subcategories', 'tests'));
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


            if ($request->hasFile('introduction_video')) {
                $video = $request->file('introduction_video');
                $videoName = time() . '_' . $video->getClientOriginalName();
                $video->move(public_path('courseVideo'), $videoName);
                $course->updateOrCreate(
                    ['id' => $course->id],
                    ['url' => $videoName]
                );
            }

            // ✅ Handle Thumbnail Upload
            if ($request->hasFile('introduction_thumbnail')) {
                $thumbnail = $request->file('introduction_thumbnail');
                $thumbnailName = time() . '_' . $thumbnail->getClientOriginalName();
                $thumbnail->move(public_path('courseThumbnail'), $thumbnailName);

                $course->updateOrCreate(
                    ['id' => $course->id],
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

    public function destroy(course $course)
    {
        //
    }
    public function getCoursesByCategory(Request $request)
    {
        // Find the category by name
        $category = Category::where('name', $request->category_name)->first();

        // Ensure $courses is always an array or collection
        $courses = $category ? Course::where('category_id', $category->id)
            ->where('is_active', 1)
            ->get() : collect([]);

        // Generate HTML dynamically
        $html = '<h2 class="mt-2">Courses</h2>';

        if ($courses->isNotEmpty()) {
            foreach ($courses as $course) {
                $html .= '
            <div class="col-lg-3 col-md-4">
                <div class="fcrse_1 mt-30">
                    <a href="' . route('course.show', $course->id) . '" class="fcrse_img">
                        <img src="' . (isset($course->thumbnail_url) && $course->thumbnail_url != null ? asset('courseThumbnail/' . $course->thumbnail_url) : asset('images/courses/img-2.jpg')) . '" alt="Course Thumbnail">
                        <div class="course-overlay">
                            ' . ($course->is_active ? '<div class="badge_seller">Active</div>' : '<div class="badge_seller">InActive</div>') . '
                            <div class="crse_reviews"><i class="uil uil-star"></i> 5</div>
                            <span class="play_btn1"><i class="uil uil-play"></i></span>
                            <div class="crse_timer">' . ($course->duration ?? 'N/A') . ' hours</div>
                        </div>
                    </a>
                    <div class="fcrse_content">
                        <div class="eps_dots more_dropdown">
                            <a href="#"><i class="uil uil-ellipsis-v"></i></a>
                            <div class="dropdown-content">
                                <span><i class="uil uil-share-alt"></i>Share</span>
                                <form class="wishlistForm">
                                    ' . csrf_field() . '
                                    <input type="hidden" name="course_id" value="' . $course->id . '">
                                    <span class="wishlistButton"><i class="uil uil-heart"></i>Save</span>
                                </form>
                                <span><i class="uil uil-windsock"></i>Report</span>
                            </div>
                        </div>
                        <div class="vdtodt">
                            <span class="vdt14">50 views</span>
                            <span class="vdt14">' . $course->created_at->diffForHumans() . '</span>
                        </div>
                        <a href="' . route('course.show', $course->id) . '" class="crse14s">' . $course->title . '</a>
                        <a href="#" class="crse-cate">' . ($course->category->name ?? 'Uncategorized') . '</a>
                        <div class="auth1lnkprce">
                            <p>By <a href="javascript:;">' . ($course->user->first_name . ' ' . $course->user->last_name ?? 'unknown') . '</a></p>
                            <div class="prce142">₹' . ($course->price ?? 'Free') . '</div>
                            <form class="cartForm">
                                ' . csrf_field() . '
                                <input type="hidden" name="course_id" value="' . $course->id . '">
                                <button type="submit" class="shrt-cart-btn" title="Add to Cart">
                                    <i class="uil uil-shopping-cart-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>';
            }
        } else {
            $html = '<p class="text-primary mt-2">No courses found for this learning path.</p>';
        }

        return response()->json($html);
    }

    public function publishCourse(Request $request)
    {
        try {
            $course = Course::where('id', $request->course_id)
                ->where('user_id', auth()->id()) // Ensure user owns the course
                ->firstOrFail();

            // Check if already published
            if ($course->is_active == 1) {
                return response()->json(['success' => false, 'message' => 'Course is already published.'], 400);
            }

            $course->is_active = 1; // Set the course as published
            $course->save();

            return response()->json(['success' => true, 'message' => 'Course published successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Something went wrong!'], 500);
        }
    }

    public function toggleStatus(Request $request, Course $course)
    {
        try {
            $course->update(['is_active' => $request->is_active]);
            return response()->json(['success' => true, 'message' => 'Course status updated successfully']);
        } catch (\Exception $e) {
            Log::error('Error updating course status', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
            return response()->json(['success' => false, 'message' => 'Failed to update course status']);
        }
    }


}