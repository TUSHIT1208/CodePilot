<?php

namespace App\Http\Controllers;

use App\Models\TestOption;
use Illuminate\Http\Request;

class TestOptionController extends Controller
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
        $validated = $request->validate([
            'option_text' => 'required|string|max:255',
        ]);

        $questionId = session()->get('question_id');
        $optionCount = TestOption::where('question_id', $questionId)->count();

        if ($optionCount >= 4) {
            return response()->json(['message' => 'Maximum options reached'], 400);
        }

        $is_correct = $request->has('is_correct');

        $option = TestOption::create([
            'question_id' => $questionId,
            'option_text' => $request->option_text,
            'is_correct' => $is_correct,
        ]);

        return response()->json(['success' => true, 'message' => 'Option added successfully!'], 201);
    }



    /**
     * Display the specified resource.
     */
    public function show(TestOption $testOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TestOption $testOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TestOption $testOption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TestOption $testOption)
    {
        //
    }
}