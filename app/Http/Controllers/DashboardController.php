<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\role;
use App\Models\User;
use App\Models\review;
use App\Models\course;
use App\Models\category;
use App\Models\order_item;
use App\Models\user_course;
use Illuminate\Http\Request;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Order;
use Illuminate\Support\Facades\Log;


class DashboardController extends Controller
{

    public function index(Request $request)
    {
        $total_earning = PaymentTransaction::sum('amount');
        logger($total_earning);
        $total_enrollments = user_course::distinct('user_id')->count('user_id');
        logger($total_enrollments);
        $total_course = course::where('is_active', 1)->count('id');
        logger($total_course);
        $total_learners = User::whereHas('role', function ($query) {
            $query->where('name', 'learner'); // Ensure this matches your database role name
        })->count();
        logger($total_learners);

        //latest course
        $courses = Course::latest()->take(3)->get();

        //most selling course
        $most_courses = Course::with(['category', 'subcategory'])
            ->withCount([
                'order_item as total_sales' => function ($query) {
                    $query->select(DB::raw('COUNT(*)')); // Count total sales
                }
            ])
            ->orderByDesc('total_sales') // Sort by most sold
            ->where('is_active', 1)
            ->take(3) // Get top 3 courses
            ->get();

        //pending course
        $pendingCourse = Course::where('is_active', 0)->latest()->first();

        //topinstructor
        $topInstructor = User::where('role_id', 2) // 2 = Instructor
            ->whereHas('course.order_item') // Ensure courses have sales
            ->withCount([
                'course as total_sales' => function ($query) {
                    $query->join('order_items', 'courses.id', '=', 'order_items.course_id');
                }
            ])
            ->withSum([
                'course as total_revenue' => function ($query) {
                    $query->join('order_items', 'courses.id', '=', 'order_items.course_id')
                        ->select(DB::raw('SUM(order_items.payable_amount)'));
                }
            ], 'total_revenue')
            ->orderByDesc('total_revenue')
            ->first();

        //top order
        if ($request->ajax()) {
            $orders = Order::select(
                'id',
                'user_id',
                'total_course',
                'total_amount',
                'total_discount',
                'payable_amount',
                'booking_number',
                'payment_status',
                'first_name',
                'last_name',
                'phone',
                'created_at'
            )
                ->orderByDesc('payable_amount'); // Sort by highest payable amount

            return DataTables::of($orders)
                ->addColumn('user', function ($order) {
                    return $order->first_name . ' ' . $order->last_name;
                })
                ->editColumn('payment_status', function ($order) {
                    return ucfirst($order->payment_status);
                })
                ->editColumn('created_at', function ($order) {
                    return $order->created_at->format('Y-m-d H:i:s');
                })
                ->rawColumns(['payment_status'])
                ->make(true);
        }

        return view('admin.dashboard', compact('total_course', 'total_earning', 'total_enrollments', 'total_learners', 'courses', 'most_courses', 'pendingCourse', 'topInstructor'));
    }

    public function instructor_index(Request $request)
    {
        logger("in instructor dashboard");
        $instructor = auth()->user(); // Get the authenticated instructor

        $courses = Course::where('user_id', $instructor)
            ->with(relations: ['userCourse.user']) // Load users who purchased
            ->get();

        // Prepare data for chart
        $courseNames = [];
        $userNames = [];

        foreach ($courses as $course) {
            foreach ($course->userCourse as $userCourse) {
                $courseNames[] = $course->title; // Course name
                $userNames[] = $userCourse->user->first_name; // User who purchased
            }
        }
        logger($userNames);
        logger($courseNames);


        // Total earnings for this instructor
        $total_earning = PaymentTransaction::whereHas('order', function ($query) use ($instructor) {
            $query->whereHas('order_items.course', function ($q) use ($instructor) {
                $q->where('user_id', $instructor->id); // Filter by instructor's courses
            });
        })->sum('amount');

        // Total enrollments for the instructor's courses
        $total_enrollments = user_course::whereHas('course', function ($query) use ($instructor) {
            $query->where('user_id', $instructor->id);
        })->distinct('user_id')->count('user_id');

        // Total courses created by the instructor
        $total_course = Course::where('user_id', $instructor->id)->where('is_active', 1)->count();

        // Latest courses by the instructor
        $courses = Course::where('user_id', $instructor->id)->where('is_active', 1)->latest()->take(3)->get();

        // Most selling courses by the instructor
        $most_courses = Course::where('user_id', $instructor->id)
            ->with(['category', 'subcategory'])
            ->withCount([
                'order_item as total_sales' => function ($query) {
                    $query->select(DB::raw('COUNT(*)')); // Count total sales
                }
            ])
            ->orderByDesc('total_sales') // Sort by most sold
            ->where('is_active', 1)
            ->take(3) // Get top 3 courses
            ->get();

        // Pending courses by the instructor
        $pendingCourse = Course::where('user_id', $instructor->id)->where('is_active', 0)->latest()->first();

        // If AJAX request, return top orders related to the instructor
        if ($request->ajax()) {
            logger('AJAX request received for top orders');

            $orders = Order::whereHas('order_items.course', function ($query) use ($instructor) {
                $query->where('user_id', $instructor->id);
            })
                ->with(['order_items.course:id,title']) // Eager load course title
                ->select(
                    'id',
                    'user_id',
                    'total_course',
                    'total_amount',
                    'total_discount',
                    'payable_amount',
                    'booking_number',
                    'payment_status',
                    'first_name',
                    'last_name',
                    'phone',
                    'created_at'
                )
                ->orderByDesc('payable_amount');

            logger('Query executed', ['query' => $orders->toSql(), 'bindings' => $orders->getBindings()]);

            return DataTables::of($orders)
                ->addColumn('user', function ($order) {
                    logger('Processing order', ['order_id' => $order->id]);
                    return $order->first_name . ' ' . $order->last_name;
                })
                ->addColumn('course_name', function ($order) {
                    $courseNames = $order->order_items->map(function ($item) {
                        return $item->course->title ?? 'N/A';
                    })->implode(', ');

                    logger('Order ID: ' . $order->id . ' - Courses: ' . $courseNames);

                    return $courseNames;
                })
                ->editColumn('payment_status', function ($order) {
                    return ucfirst($order->payment_status);
                })
                ->editColumn('created_at', function ($order) {
                    return $order->created_at->format('Y-m-d H:i:s');
                })
                ->rawColumns(['payment_status'])
                ->make(true);
        }


        return view('instructor.dashboard', compact(
            'total_course',
            'total_earning',
            'total_enrollments',
            'courses',
            'most_courses',
            'pendingCourse',
            'courseNames',
            'userNames'
        ));
    }

    public function learner_index()
    {

        $total_course = course::where('is_active', 1)->count('id');
        logger($total_course);
        $total_purcharsed_course = user_course::where('user_id', auth()->user()->id)->count('id');
        logger($total_purcharsed_course);
        $total_learners = User::whereHas('role', function ($query) {
            $query->where('name', 'learner'); // Ensure this matches your database role name
        })
            ->whereHas('orders') // Ensure the learner has at least one order
            ->count();
        logger($total_learners);


        $most_courses = Course::with(['category', 'subcategory'])
            ->withCount([
                'order_item as total_sales' => function ($query) {
                    $query->select(DB::raw('COUNT(*)')); // Count total sales
                }
            ])
            ->orderByDesc('total_sales') // Sort by most sold
            ->take(3) // Get top 3 courses
            ->get();
        $latest_courses = Course::where('is_active', 1)->latest()->take(3)->get();

        $courses = Course::whereHas('review') // Only fetch courses that have reviews
            ->with([
                'review' => function ($query) {
                    $query->orderByDesc('rating'); // Sort reviews from highest to lowest
                },
                'review.user'
            ])->take(5)
            ->get();
        //dd($courses->toArray());  

        // course purchase chart
        $purchasesByMonth = PaymentTransaction::select(
            DB::raw("DATE_FORMAT(created_at, '%M') as month"),
            DB::raw("COUNT(id) as total_purchases")
        )
            ->where('created_by', auth()->user()->id)
            ->groupBy('month')
            ->orderBy(DB::raw("STR_TO_DATE(month, '%M')"), 'asc')
            ->get();
        return view('learner.dashboard', compact('most_courses', 'courses', 'total_learners', 'total_course', 'total_purcharsed_course', 'latest_courses', 'purchasesByMonth'));
    }


    public function courseList(Request $request)
{
    if ($request->ajax()) {
        $user_id = auth()->user()->id;
        $query = User_course::where('user_id', $user_id)->with('course');

        // ✅ Show all courses if "All Courses" is selected
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        // ✅ Filter by Category (if selected)
        if ($request->filled('category_id')) {
            $query->whereHas('course', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }

        // ✅ Filter by Subcategory (if selected)
        if ($request->filled('subcategory_id')) {
            $query->whereHas('course', function ($q) use ($request) {
                $q->where('sub_category_id', $request->subcategory_id);
            });
        }

        $purchased_courses = $query->get();
        $data = [];

        foreach ($purchased_courses as $course) {
            $course_details = $course->course;
            if (!$course_details) continue;

            $total_learners = User_course::where('course_id', $course->course_id)->count();
            $final_price = ($course_details->price ?? 0) - ($course_details->discount ?? 0);

            $data[] = [
                'title' => $course_details->title,
                'total_learners' => $total_learners,
                'final_price' => $final_price,
                'actions' => '<a href="' . route('course.show', $course->course_id) . '" class="text-dark"><i class="uil uil-eye"></i> View</a>'
            ];
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => count($data),
            'recordsFiltered' => count($data),
            'data' => $data
        ]);
    }

    $courses = User_course::where('user_id', auth()->user()->id)->with('course')->get();
    $categories = Category::all();

    return view('learner.reports.course_learner.list', compact('courses', 'categories'));
}


    public function total_earning(Request $request)
    {

        $query = PaymentTransaction::whereIn('order_id', function ($query) {
            $query->select('order_id')
                ->from('order_items')
                ->whereIn('course_id', function ($subQuery) {
                    $subQuery->select('id')
                        ->from('courses');
                });
        });
        // Filter by Course ID
        if ($request->has('course_id') && !empty($request->course_id)) {
            $query->whereHas('order.order_items', function ($q) use ($request) {
                $q->where('course_id', $request->course_id);
            });
        }

        // Filter by Category
        if ($request->filled('category_id')) {
            \Log::info('Filtering by Category ID:', ['category_id' => $request->category_id]);
            $query->whereHas('order.order_items.course', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }

        // Filter by Subcategory
        if ($request->filled('subcategory_id')) {
            \Log::info('Filtering by Subcategory ID:', ['subcategory_id' => $request->subcategory_id]);
            $query->whereHas('order.order_items.course', function ($q) use ($request) {
                $q->where('sub_category_id', $request->subcategory_id);
            });
        }


        // Filter by Date Range
        if ($request->has('date_range') && !empty($request->date_range)) {
            $dates = explode(' - ', $request->date_range);
            if (count($dates) == 2) {
                $startDate = Carbon::parse($dates[0])->startOfDay();
                $endDate = Carbon::parse($dates[1])->endOfDay();
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }
        }

        // Get filtered transactions
        $paymentTransactions = $query->get();

        // Handle AJAX request for DataTables
        if ($request->ajax()) {
            return DataTables::of($paymentTransactions)
                ->addColumn('course_name', function ($row) {
                    return $row->order->order_items->pluck('course.title')->join(', ') ?? 'N/A';
                })
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('d M Y, h:i A');
                })
                ->make(true);
        }

        // Fetch all courses for the dropdown
        $courses = Course::where('user_id', auth()->user()->id)->get();
        $categories = category::all();
        return view('admin.report.total_earning.list', compact('paymentTransactions', 'courses', 'categories'));

    }


    public function total_enroll(Request $request)
    {
        $query = User_course::with(['user', 'course']);

        if ($request->ajax()) {
            if ($request->filled('course_id')) {
                $query->where('course_id', $request->course_id);
            }
            \Log::info('Request Data:', $request->all());

            // Filter by Category
            if ($request->filled('category_id')) {
                \Log::info('Filtering by Category ID:', ['category_id' => $request->category_id]);
                $query->whereHas('course', function ($q) use ($request) {
                    $q->where('category_id', $request->category_id);
                });
            }

            // Filter by Subcategory
            if ($request->filled('subcategory_id')) {
                \Log::info('Filtering by Subcategory ID:', ['sub_category_id' => $request->subcategory_id]);
                $query->whereHas('course', function ($q) use ($request) {
                    $q->where('sub_category_id', $request->subcategory_id);
                });
            }


            // Date Range Filtering
            if ($request->filled('date_range')) {
                $dates = explode(' - ', $request->date_range);
                $startDate = Carbon::parse($dates[0])->startOfDay();
                $endDate = Carbon::parse($dates[1])->endOfDay();

                $query->whereBetween('created_at', [$startDate, $endDate]);
            }
            \Log::info($query->toSql(), $query->getBindings());
            return DataTables::of($query)
                ->addColumn('learner_name', function ($row) {
                    return optional($row->user)->first_name ?? 'N/A';
                })
                ->addColumn('course_title', function ($row) {
                    return optional($row->course)->title ?? 'N/A';
                })
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('d M Y, h:i A');
                })
                ->rawColumns(['learner_name', 'course_title', 'created_at'])
                ->make(true);
        }

        $courses = Course::all();
        $categories = category::all();
        return view('admin.report.total_enroll.list', compact('courses', 'categories'));

    }


    public function instructor_total_earning(request $request)
    {

        logger("in instrctor total_earning");
        $instructor = auth()->user(); // Get authenticated instructor

        // Fetch only payment transactions related to instructor's courses
        $query = PaymentTransaction::whereHas('order.order_items.course', function ($q) use ($instructor) {
            $q->where('user_id', $instructor->id);
        });

        // Filter by Course ID
        if ($request->filled('course_id')) {
            \Log::info('Filtering by Course ID:', ['course_id' => $request->course_id]);
            $query->whereHas('order.order_items', function ($q) use ($request) {
                $q->where('course_id', $request->course_id);
            });
        }

        // // Filter by Category
        if ($request->filled('category_id')) {
            \Log::info('Filtering by Category ID:', ['category_id' => $request->category_id]);
            $query->whereHas('order.order_items.course', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }

        // Filter by Subcategory
        if ($request->filled('subcategory_id')) {
            \Log::info('Filtering by Subcategory ID:', ['subcategory_id' => $request->subcategory_id]);
            $query->whereHas('order.order_items.course', function ($q) use ($request) {
                $q->where('sub_category_id', $request->subcategory_id);
            });
        }

        // Filter by Date Range
        if ($request->filled('date_range')) {
            \Log::info("Received date_range:", ['date_range' => $request->date_range]);
            $dates = explode(' - ', $request->date_range);

            if (count($dates) == 2) {
                $startDate = Carbon::parse(trim($dates[0]))->startOfDay();
                $endDate = Carbon::parse(trim($dates[1]))->endOfDay();

                \Log::info("Filtering by Date Range:", ['start' => $startDate, 'end' => $endDate]);
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }
        }

        // Get filtered transactions
        $paymentTransactions = $query->get();

        // Handle AJAX request for DataTables
        if ($request->ajax()) {
            return DataTables::of($query)
                ->addColumn('course_name', function ($row) {
                    return $row->order->order_items->pluck('course.title')->join(', ') ?? 'N/A';
                })
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('d M Y, h:i A');
                })
                ->make(true);
        }

        // Fetch instructor's courses for filtering dropdown
        $courses = Course::where('user_id', $instructor->id)->where('is_active', 1)->get();
        $categories = Category::all();

        return view('instructor.report.total_earning.list', compact('paymentTransactions', 'courses', 'categories'));
    }


    public function instructor_total_enroll(Request $request)
    {
        $instructorId = auth()->id(); // Get the authenticated instructor ID

        $query = User_course::with(['user', 'course'])
            ->whereHas('course', function ($q) use ($instructorId) {
                $q->where('user_id', $instructorId);
            });

        if ($request->ajax()) {
            if ($request->filled('course_id')) {
                $query->where('course_id', $request->course_id);
            }

            \Log::info('Request Data:', $request->all());

            // Filter by Category
            if ($request->filled('category_id')) {
                \Log::info('Filtering by Category ID:', ['category_id' => $request->category_id]);
                $query->whereHas('course', function ($q) use ($request) {
                    $q->where('category_id', $request->category_id);
                });
            }

            // Filter by Subcategory
            if ($request->filled('subcategory_id')) {
                \Log::info('Filtering by Subcategory ID:', ['sub_category_id' => $request->subcategory_id]);
                $query->whereHas('course', function ($q) use ($request) {
                    $q->where('sub_category_id', $request->subcategory_id);
                });
            }

            // Date Range Filtering
            if ($request->filled('date_range')) {
                $dates = explode(' - ', $request->date_range);
                $startDate = Carbon::parse($dates[0])->startOfDay();
                $endDate = Carbon::parse($dates[1])->endOfDay();

                $query->whereBetween('created_at', [$startDate, $endDate]);
            }

            \Log::info($query->toSql(), $query->getBindings());

            return DataTables::of($query)
                ->addColumn('learner_name', function ($row) {
                    return optional($row->user)->first_name ?? 'N/A';
                })
                ->addColumn('course_title', function ($row) {
                    return optional($row->course)->title ?? 'N/A';
                })
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->format('d M Y, h:i A');
                })
                ->rawColumns(['learner_name', 'course_title', 'created_at'])
                ->make(true);
        }

        $courses = Course::where('user_id', $instructorId)->where('is_active', 1)->get();
        $categories = Category::all();

        return view('instructor.report.total_enroll.list', compact('courses', 'categories'));
    }

    public function learner_purchesed_course(Request $request)
    {
        $userId = auth()->id();



        // Fetch purchased courses with course details
        $courses = User_course::with('course')
            ->where('user_id', $userId)
            ->get();

        // Fetch payment transactions for the authenticated user
        $transactions = PaymentTransaction::where('created_by', $userId)->get();

        // Prepare formatted data for DataTables
        $formattedCourses = $courses->map(function ($course) use ($transactions) {
            $transaction = $transactions->where('order_id', $course->course_id)->first();

            return [
                'title' => $course->course->title ?? 'N/A',
                'category_id' => $course->course->category_id ?? null,
                'sub_category_id' => $course->course->sub_category_id ?? null,
                'total_amount' => $transaction ? '₹' . number_format($transaction->amount, 2) : 'N/A',
                'created_at' => $course->created_at ? $course->created_at->format('Y-m-d H:i:s') : 'N/A'
            ];
        });
        if ($request->filled('date_range')) {
            $dates = explode(' - ', $request->date_range);
            $startDate = Carbon::parse(trim($dates[0]))->startOfDay();
            $endDate = Carbon::parse(trim($dates[1]))->endOfDay();

            // Filter courses within the selected date range
            $formattedCourses = $formattedCourses->filter(function ($course) use ($startDate, $endDate) {
                return Carbon::parse($course['created_at'])->between($startDate, $endDate);
            });
        }

        if ($request->filled('category_id')) {
            $formattedCourses = $formattedCourses->where('category_id', $request->category_id);
        }

        // Apply subcategory filter
        if ($request->filled('subcategory_id')) {
            $formattedCourses = $formattedCourses->where('sub_category_id', $request->subcategory_id);
        }

        if ($request->ajax()) {
            return DataTables::of($formattedCourses)->make(true);
        }
        $categories = Category::all();
        return view('learner.reports.purchesed_course.list', compact('formattedCourses', 'categories'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }

    public function course(Request $request)
    {
        if ($request->ajax()) {
            $courses = Course::with(['courseattachment', 'user'])->select('id', 'title', 'user_id', 'created_at');

            return datatables()->of($courses)
                ->addColumn('instructor', function ($course) {
                    return $course->user ? $course->user->name : 'N/A';
                })
                ->addColumn('attachments', function ($course) {
                    return $course->courseattachment ? count($course->courseattachment) . ' files' : 'No Attachments';
                })
                ->make(true);
        }

        return view('admin.report.total_course.list');
    }


    public function learner_course(Request $request)
    {
        if ($request->ajax()) {
            $courses = Course::with(['courseattachment', 'user'])->select('id', 'title', 'user_id', 'created_at');

            return datatables()->of($courses)
                ->addColumn('instructor', function ($course) {
                    return $course->user ? $course->user->name : 'N/A';
                })
                ->addColumn('attachments', function ($course) {
                    return $course->courseattachment ? count($course->courseattachment) . ' files' : 'No Attachments';
                })
                ->make(true);
        }

        return view('learner.reports.total_course.list');

    }


    public function learner(Request $request)
    {
        if ($request->ajax()) {
            $query = User::select(
                'users.id',
                'users.first_name',
                'users.middle_name',
                'users.last_name',
                'users.email',
                'users.phone_number',
                'users.profile_picture_url',
                'users.is_active'
            )
                ->leftJoin('user_courses', 'users.id', '=', 'user_courses.user_id') // Allow users without courses
                ->leftJoin('courses', 'user_courses.course_id', '=', 'courses.id')
                ->where('users.role_id', 3); // Only learners

            if ($request->category_id) {
                $query->where('courses.category_id', $request->category_id);
            }

            if ($request->subcategory_id) {
                $query->where('courses.sub_category_id', $request->subcategory_id);
            }

            return DataTables::of($query)
                ->addColumn('profile_picture_url', function ($learner) {
                    return !empty($learner->profile_picture_url)
                        ? '<img id="profile_picture" src="' . asset($learner->profile_picture_url) . '" width="40" class="rounded-circle">'
                        : '<h1 class="default_avtar">' . strtoupper(substr($learner->first_name, 0, 1)) . '</h1>';
                })
                ->addColumn('is_active', function ($user) {
                    return $user->is_active ? '<span class="badge badge-success active-learner">Active</span>' : '<span class="badge badge-danger inctive-learner">Inactive</span>';
                })
                ->addColumn('full_name', function ($user) {
                    return trim($user->first_name . ' ' . ($user->middle_name ?? '') . ' ' . $user->last_name);
                })
                ->filterColumn('full_name', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(first_name, ' ', COALESCE(middle_name, ''), ' ', last_name) LIKE ?", ["%{$keyword}%"]);
                })
                ->orderColumn('full_name', function ($query, $order) {
                    $query->orderByRaw("CONCAT(first_name, ' ', COALESCE(middle_name, ''), ' ', last_name) {$order}");
                })
                ->rawColumns(['profile_picture_url', 'is_active', 'full_name'])
                ->make(true);
        }

        $learners = User::where('role_id', 3)->get(); // Get all learners initially
        $categories = Category::all();

        return view('admin.report.total_learner.list', compact('learners', 'categories'));
    }


}
