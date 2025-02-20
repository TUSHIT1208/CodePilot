<?php

namespace App\Http\Controllers;

use App\Models\TestQuestion;
use Illuminate\Http\Request;

class TestQuestionController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'question_text' => 'required|string|max:255',
            'score' => 'required|numeric|min:0',
        ]);

        // Create a new test question
        $testquestion = TestQuestion::create([
            'test_id' => session()->get('test_id'),
            'question_text' => $request->question_text,
            'score' => $request->score,
        ]);

        session()->put('question_id', $testquestion->id);

        // Return a JSON response to be handled by the front-end
        return response()->json([
            'success' => true,
            'message' => 'Question added successfully!',
        ]);


    }

    /**
     * Display the specified resource.
     */
    public function show(TestQuestion $testQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TestQuestion $testQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TestQuestion $testQuestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TestQuestion $testQuestion)
    {
        //
    }
}