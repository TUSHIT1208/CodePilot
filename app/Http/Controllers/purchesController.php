<?php

namespace App\Http\Controllers;
use App\Models\course;
use Illuminate\Http\Request;

class purchesController extends Controller
{
public function purches_index($id)
    {
        $courses = Course::with(['courseattachment', 'user'])
                     ->where('sub_category_id', $id)
                     ->where('is_active',1)
                     ->get();
                     //return $courses;
        return view('learner.course.list', compact('courses'));
    }
}
