<?php

namespace App\Http\Controllers;

use App\Models\LearningPath;
use Illuminate\Http\Request;

class LearningPathController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $learningpath = LearningPath::paginate(3);
        return view('admin.learningpath.learning_path', compact('learningpath'));
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($request->ajax()) {
            if ($validated) {
                // Create the learning path
                LearningPath::create($request->all());

                // Return success response
                return response()->json([
                    'success' => true,
                    'message' => 'Learning path added successfully.'
                ]);
            }
        }

        // If not an AJAX request, continue as usual (standard response)
        return redirect()->route('learningpath.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(LearningPath $learningPath)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LearningPath $learningPath)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        try {
            // Find the learning path by ID
            $learningPath = LearningPath::findOrFail($id);

            // Update only the provided fields
            $learningPath->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);

            // Redirect with success message
            return redirect()->route('learningpath.index')->with('success', 'Learning path updated successfully.');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error updating learning path: ' . $e->getMessage());

            // Redirect with an error message
            return redirect()->route('learningpath.index')->with('error', 'Failed to update learning path. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $learningPath = LearningPath::findOrFail($id);
        $learningPath->delete();
        return redirect()->back()->with('success', 'Learning Path deleted successfully!');
    }
}