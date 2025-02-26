<?php

namespace App\Http\Controllers;

use App\Models\test;
use Illuminate\Http\Request;

class TestController extends Controller
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
    public function create()
    {
        return view('admin.course.test');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'test_title' => 'required|string|max:255',
            'passing_mark' => 'required|numeric|min:0',
        ]);

        // Insert into the database
        $test = Test::create([
            'course_id' => session()->get('course_id'), // Get course_id from session
            'test_title' => $request->input('test_title'),
            'passing_mark' => $request->input('passing_mark'),
        ]);

        // Store test_id in session after successful insertion
        // session()->put('test_id', $test->id);

        return response()->json([
            'success' => true,
            'message' => 'Test added successfully!',
            'test_id' => $request->course_id
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(test $test)
    {
        //
    }
}