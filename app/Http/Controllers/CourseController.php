<?php

namespace App\Http\Controllers;

use App\Models\test;
use App\Models\test_result;
use App\Models\TestQuestion;
use App\Models\User;
use App\Models\video;
use App\Models\course;
use App\Models\category;
use App\Models\certificate;
use App\Models\user_course;
use App\Models\sub_category;
use Illuminate\Http\Request;
use App\Mail\CoursePublished;
use App\Models\courseAttachment;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use function PHPUnit\Framework\isEmpty;

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
                'debugger' => 'required',
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
                'is_active_home' => 0,
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
                'debugger' => $request->debugger,
            ]);

            Log::info('Course created successfully', ['course_id' => $course->id]);

            // return redirect()->route('course.edit', $course->id)->with('success', 'Course inserted successfully');
            // DB::commit(); // Commit the transaction
            return response()->json([
                'success' => true,
                'message' => 'Course created successfully',
                'course_id' => $course->id,
                'redirect_url' => route('course.edit', $course->id) . '?tab=tab_step2'
            ], 200);


        } catch (\Exception $e) {
            Log::error('Error inserting course', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'error' => true,
                'message' => 'An error occurred while inserting the course.',
                'details' => $e->getMessage()
            ], 500);

            // return redirect()->back()->with('error', 'An error occurred while inserting the course.');
        }
    }

    public function show($id)
    {
        $courseDetail = Course::with([
            'category',
            'subcategory',
            'courseattachment' => function ($query) {
                $query->orderBy('position', 'asc'); // Order media by position
            }
        ])->where('id', $id)->first();
        $users = User::find($courseDetail->user_id);
        $cid = $courseDetail->id;
        session()->put('course', $cid);
        $userId = auth()->user()->id;

        $checkPurchase = user_course::where('user_id', $userId)->where('course_id', $cid)->first();

        $total_enrolled = user_course::where('course_id', $cid)->count();
        logger('total_enrolled: ' . $total_enrolled.'course_title: '.$courseDetail->title);

        $test = test::where('course_id', $cid)->first();
        if ($test) {
            $test_result = test_result::where('test_id', $test->id)
            ->where('user_id', $userId)
            ->latest('id') // Orders by ID in descending order
                ->first();

            if ($test_result === null) {
                $score = 0;
            } else {
                $score = $test_result->overall_score;
            }
            
        }

        $coursePrice = course::where('id', $cid)->first();

        if (auth()->user()->role->name === 'admin') {
            return view('admin.course.each_course', compact('courseDetail', 'users','total_enrolled'));
        } else if (auth()->user()->role->name === 'insructor') {
            return view('instructor.course.each_course', compact('courseDetail', 'users','total_enrolled'));
        } else if (auth()->user()->role->name === 'learner') {
            return view('learner.course.each_course', compact('courseDetail', 'users', 'checkPurchase', 'coursePrice', 'test', 'score','total_enrolled'));
        }
    }
    public function edit($id, Request $request)
    {
        $course = Course::findOrFail($id); // Load course with attachments
        $tab = request()->query('tab', ''); // ✅ Get tab from query string

        // return $course;
        $categories = Category::all(); // Fetch all categories
        $subcategories = Sub_category::all(); // Fetch all subcategories (if needed)
        $tests = test::where('course_id', $id)->select('id')->first();
        if (isset($tests->id)) {
            $test_question = TestQuestion::where('test_id', $tests->id)
                ->orderBy('position', 'asc') // Order by position
                ->get();
        } else {
            $test_question = collect(); // Return an empty collection instead of 0
        }
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
            return view('admin.course.create_new_course', compact('course', 'categories', 'subcategories', 'tests', 'test_question', 'tab'));
        } else if (auth()->user()->role->name == 'insructor') {
            return view('instructor.course.create_new_course', compact('course', 'categories', 'subcategories', 'tests', 'test_question'));
        }
    }

    public function update(Request $request, Course $course)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|min:3|max:255',
                'description' => 'required|string|min:10',
                'course_description' => 'required|string',
                'learn_in_course' => 'required|string|min:10',
                'requirement' => 'required|string|min:10',
                'course_level' => 'required|string|in:Beginner,Intermediate,Expert',
                'course_type' => 'required|string|in:text,video',
                'category_id' => 'required|exists:categories,id',
                'sub_category_id' => 'required|exists:sub_categories,id',
                'meta_keyword' => 'required|string|min:3|max:255',
                'meta_title' => 'required|string|min:3|max:255',
                'meta_description' => 'required|string|min:10',
                'debugger' => 'required',
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
                'debugger',
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

            // return redirect()->back()->with('success', 'course updated successfully');
            return response()->json([
                'success' => true,
                'message' => 'Course Update successfully',
                'course_id' => $course->id
            ], 200);

        } catch (\Exception $e) {
            Log::error('Error inserting course', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => true,
                'message' => 'An error occurred while Update the course.',
                'details' => $e->getMessage()
            ], 500);

            // return redirect()->back()->with('error', 'An error occurred while updateing the course.');
        }
    }
    public function toggleHomeStatus(Request $request)
    {
        $course = Course::findOrFail($request->course_id); // Find the course by ID

        // If currently added to home, remove it
        if ($course->is_active_home) {
            $course->is_active_home = false;
            $course->published_at = null;
            $course->save();

            return response()->json(['success' => true, 'message' => 'Course removed from home.']);
        }

        // Check conditions before adding to home
        $hasTest = Test::where('course_id', $course->id)->exists();
        if (!$hasTest) {
            return response()->json(['success' => false, 'message' => 'At least one test is required to publish this course.'], 400);
        }

        $hasMedia = CourseAttachment::where('course_id', $course->id)->exists();
        if (!$hasMedia) {
            return response()->json(['success' => false, 'message' => 'At least one media file is required to publish this course.'], 400);
        }

        // Add to home
        $course->is_active_home = true;
        $course->published_at = now();
        $course->save();

        return response()->json(['success' => true, 'message' => 'Course added to home.']);
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
                            <div class="course-overlay learning-path-course-overlay">
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
                                <div class="prce142">
                                    ' . ($course->price == 0 ? 'Free' : ($course->discount > 0 ? '<s style="text-decoration-color: red; font-size: 0.9em;">₹' . $course->price . '</s> ₹' . ($course->price - ($course->discount ?? 0)) : '₹' . $course->price)) . '
                                </div>';
        
                if ($course->price != 0) {
                    $html .= ' <form class="cartForm">
                                ' . csrf_field() . '
                                <input type="hidden" name="course_id" value="' . $course->id . '">
                                <button type="submit" class="shrt-cart-btn" title="Add to Cart">
                                    <i class="uil uil-shopping-cart-alt"></i>
                                </button>
                            </form>';
                }
                $html .= '</div>
                    </div>
                </div>
            </div>';
            }
        } else {
            $html = '<p class="text-primary mt-2">No courses found for this learning path.</p>';
        }

        return response()->json($html);
    }

    public function togglePublish(Request $request)
    {
        try {
            logger('Processing publish toggle for course...');

            $course = Course::where('id', $request->course_id)
                //->where('user_id', auth()->id()) // Ensure user owns the course
                ->firstOrFail();

            logger('Course found: ' . $course->title);

            // Check if publishing is possible
            if (!$course->is_active) {
                $hasTest = Test::where('course_id', $course->id)->exists();
                if (!$hasTest) {
                    return response()->json(['success' => false, 'message' => 'At least one test is required to publish this course.'], 400);
                }

                $hasMedia = courseAttachment::where('course_id', $course->id)->exists();
                if (!$hasMedia) {
                    return response()->json(['success' => false, 'message' => 'At least one media file is required to publish this course.'], 400);
                }
            }

            // Toggle the is_active status
            $course->is_active = !$course->is_active;
            $course->save();

            try {
                logger('Sending email to course creator: ' . $course->user->email);
                Mail::to($course->user->email)->send(new CoursePublished($course, true));
                logger('Email sent to course creator: ' . $course->user->email);
            } catch (\Exception $e) {
                logger('Error sending email to course creator: ' . $e->getMessage());
            }
           
            //Send email to all learners
            $learners = User::whereHas('role', function ($query) {
                $query->where('name', 'learner');
            })->get();

            logger('Learners found: ' . $learners->count());

            foreach ($learners as $learner) {
                logger('Start sending email to: ' . $learner->email);
                try {
                    Mail::to($learner->email)->send(new CoursePublished($course, false));
                    logger('Email sent to: ' . $learner->email);
                } catch (\Exception $e) {
                    logger('Error sending email to ' . $learner->email . ': ' . $e->getMessage());
                }
            }

            logger('All emails processed.');
            return response()->json([
                'success' => true,
                'message' => $course->is_active ? 'Course published successfully!' : 'Course unpublished successfully!'
            ]);

        } catch (\Exception $e) {
            logger('Error toggling publish status: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Something went wrong!'], 500);
        }
    }
    public function instructor_course(Request $request)
    {
        $courses = Course::with(['courseattachment', 'user'])
            ->whereHas('user', function ($query) {
                $query->where('role_id', 2);
            })
            ->get();

        //return $courses;
        Log::info('Fetched courses successfully', ['courses_count' => $courses->count()]);
        if (auth()->user()->role->name == 'admin') {
            return view('admin.instructor_course.list', compact('courses'));
        }
    }




}