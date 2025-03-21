<?php

namespace App\Http\Controllers;

use App\Models\role;
use App\Models\User;
use App\Models\course;
use App\Models\user_course;
use Illuminate\Http\Request;
use App\Models\PaymentTransaction;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;


class DashboardController extends Controller
{

    public function index()
    {
        $total_earning=PaymentTransaction::sum('amount');
        logger($total_earning);
        $total_enrollments =user_course::distinct('user_id')->count('user_id');
        logger($total_enrollments);
        $total_course =course::count('id');
        logger($total_course);
        $total_learners = User::whereHas('role', function ($query) {
            $query->where('name', 'learner'); // Ensure this matches your database role name
        })->count();
        
        logger($total_learners);
    
        return view('admin.dashboard',compact('total_course','total_earning','total_enrollments','total_learners'));
    }
    public function total_earning(Request $request) {
        $query = PaymentTransaction::whereIn('order_id', function ($query) {
            $query->select('order_id')
                ->from('order_items')
                ->whereIn('course_id', function ($subQuery) {
                    $subQuery->select('id')
                        ->from('courses')
                        ->where('user_id', auth()->user()->id);
                });
        });
    
        // Filter by Course ID
        if ($request->has('course_id') && !empty($request->course_id)) {
            $query->whereHas('order.order_items', function ($q) use ($request) {
                $q->where('course_id', $request->course_id);
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
    
        return view('admin.report.total_earning.list', compact('paymentTransactions', 'courses'));
    }
    

    public function total_enroll(Request $request) {
        $query = User_course::with(['user', 'course']);

        if ($request->ajax()) {
            if ($request->filled('course_id')) {
                $query->where('course_id', $request->course_id);
            }

            // Date Range Filtering
            if ($request->filled('date_range')) {
                $dates = explode(' - ', $request->date_range);
                $startDate = Carbon::parse($dates[0])->startOfDay();
                $endDate = Carbon::parse($dates[1])->endOfDay();

                $query->whereBetween('created_at', [$startDate, $endDate]);
            }

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
        return view('admin.report.total_enroll.list', compact('courses'));
    
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

    public function course()
    {
        $courses = Course::with(['courseattachment', 'user'])->get();
        return view('admin.report.total_course.list', compact('courses'));
        // return $courses;
    }

    public function learner(Request $request)
    {
        if ($request->ajax()) {
            $learners = User::select([
                'id',
                'profile_picture_url',
                'first_name',
                'middle_name',
                'last_name',
                'email',
                'phone_number',
                'is_active'
            ])->where('role_id', 3);

            return DataTables::of($learners)
                ->addColumn('profile', function ($learner) {
                    return !empty($learner->profile_picture_url)
                        ? '<img id="profile_picture" src="' . asset($learner->profile_picture_url) . '" width="40">'
                        : '<h1 id="default_avtar">' . strtoupper(substr($learner->first_name, 0, 1)) . '</h1>';
                })
                ->addColumn('full_name', function ($row) {
                    return $row->first_name . ' ' . ($row->middle_name ? $row->middle_name . ' ' : '') . $row->last_name;
                })
                ->addColumn('status', function ($row) {
                    return $row->is_active ? '<span class="badge badge-success active-learner">Active</span>' : '<span class="badge badge-danger inctive-learner">Inactive</span>';
                })
                ->rawColumns(['profile', 'status'])
                ->make(true);
        }

        $learners = User::where('role_id', 3)->get();
        return view('admin.report.total_learner.list', compact('learners'));
    }
}
