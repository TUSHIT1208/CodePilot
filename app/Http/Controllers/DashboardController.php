<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\course;
use App\Models\sub_category;
use App\Models\User;
use App\Models\user_course;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{

    public function index()
    {
        //
    }


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


    // public function learner(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $learners = User::select([
    //             'id',
    //             'profile_picture_url',
    //             'first_name',
    //             'middle_name',
    //             'last_name',
    //             'email',
    //             'phone_number',
    //             'is_active'
    //         ])->where('role_id', 3);

    //         return DataTables::of($learners)
    //             ->addColumn('profile', function ($learner) {
    //                 return !empty($learner->profile_picture_url)
    //                     ? '<img id="profile_picture" src="' . asset($learner->profile_picture_url) . '" width="40">'
    //                     : '<h1 id="default_avtar">' . strtoupper(substr($learner->first_name, 0, 1)) . '</h1>';
    //             })
    //             ->addColumn('full_name', function ($row) {
    //                 return $row->first_name . ' ' . ($row->middle_name ? $row->middle_name . ' ' : '') . $row->last_name;
    //             })
    //             ->addColumn('status', function ($row) {
    //                 return $row->is_active ? '<span class="badge badge-success active-learner">Active</span>' : '<span class="badge badge-danger inctive-learner">Inactive</span>';
    //             })
    //             ->rawColumns(['profile', 'status'])
    //             ->make(true);
    //     }

    //     $learners = User::where('role_id', 3)->get();
    //     $categories = category::all();
    //     $userCourses = user_course::get();
    //     return view('admin.report.total_learner.list', compact('learners','categories'));
    // }

    public function learner(Request $request)
    {
        if ($request->ajax()) {
            $query = User::select(
                'users.id',
                'users.first_name',
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
                        : '<h1 id="default_avtar">' . strtoupper(substr($learner->first_name, 0, 1)) . '</h1>';
                })
                ->addColumn('is_active', function ($user) {
                    return $user->is_active ? '<span class="badge badge-success active-learner">Active</span>' : '<span class="badge badge-danger inctive-learner">Inactive</span>';
                })
                ->rawColumns(['profile_picture_url', 'is_active'])
                ->make(true);
        }

        $learners = User::where('role_id', 3)->get(); // Get all learners initially
        $categories = Category::all();

        return view('admin.report.total_learner.list', compact('learners', 'categories'));
    }

}
