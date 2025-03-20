<?php

namespace App\Http\Controllers;

use App\Models\course;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $learnerCount = User::where('role_id', 3)->count();
        $instructorCount = User::where('role_id', 2)->count();
        $courseCount = course::where('is_active', 1)->count();
        $courses = Course::with('user')->where('is_active', 1)->take(3)->get();


        return view('front.index', compact('learnerCount', 'courses', 'instructorCount', 'courseCount'));
    }

    public function about()
    {
        $learnerCount = User::where('role_id', 3)->count();
        $instructorCount = User::where('role_id', 2)->count();
        $courseCount = course::where('is_active', 1)->count();

        return view('front.about', compact('learnerCount', 'instructorCount', 'courseCount'));
    }
    public function course()
    {
        // Get active courses and load the user associated with each course
        $courses = Course::with('user')->where('is_active_home', 1)->get();
        //return $courses;
        // Pass courses to the view
        return view('front.course', compact('courses'));
    }

}