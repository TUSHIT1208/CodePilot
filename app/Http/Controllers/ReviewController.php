<?php

namespace App\Http\Controllers;

use App\Models\review;
use Illuminate\Http\Request;

class ReviewController extends Controller
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
        logger('in review');
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        $review=Review::create([
            'user_id' => auth()->user()->id,
            'course_id' => $request->course_id,
            'rating' => $request->rating,
            'review' => $request->review,
            'created_by' => auth()->user()->id
        ]);
        logger('create..'. $review);

        return response()->json(['success' => 'Review submitted successfully']);
    }
    public function getReview($courseId)
    {
        $reviews = Review::with('user') // Load user data (name, profile)
        ->where('course_id', $courseId)
        ->get();

    logger($reviews);

    return response()->json($reviews);
    }

    /**
     * Display the specified resource.
     */
    public function show(review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(review $review)
    {
        //
    }
}
