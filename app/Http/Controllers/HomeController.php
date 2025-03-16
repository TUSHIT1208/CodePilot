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
        $courseCount = course::all()->count();
    
        return view('front.index', compact('learnerCount', 'instructorCount','courseCount'));
    }
    
    public function about()
    {
        $learnerCount = User::where('role_id', 3)->count();
        $instructorCount = User::where('role_id', 2)->count();
        $courseCount = course::all()->count();
    
        return view('front.about', compact('learnerCount', 'instructorCount','courseCount'));
    }  
}
