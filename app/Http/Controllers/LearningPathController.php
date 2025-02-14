<?php

namespace App\Http\Controllers;

use App\Models\LearningPath;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LearningPathController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = LearningPath::select('id', 'name', 'description');

            return DataTables::of($data)
                ->addColumn('checkbox', function ($row) {
                    return '<input type="checkbox" class="learningpath-checkbox" name="learningpath_checkbox[]" value="' . $row->id . '">';
                })
                ->addColumn('actions', function ($row) {
                    return '<a href="#" title="Edit" class="gray-s edit-btn" 
                                data-id="' . $row->id . '" 
                                data-name="' . htmlspecialchars($row->name, ENT_QUOTES) . '" 
                                data-description="' . htmlspecialchars($row->description, ENT_QUOTES) . '">
                                <i class="uil uil-edit-alt ucp-table"></i>
                            </a>
                            <a href="javascript:;" title="Delete" class="gray-s delete-btn" data-id="' . $row->id . '">
                                <i class="uil uil-trash-alt ucp-table"></i>
                            </a>';
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }
        $learningpath = LearningPath::paginate(3);
        return view('admin.learningpath.learning_path', compact('learningpath'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($request->ajax()) {
            LearningPath::create($validated);
            return response()->json(['success' => 'Learning path added successfully.']);
        }

        return redirect()->route('learningpath.index')->with('success', 'Learning path added successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $learningPath = LearningPath::findOrFail($id);
        $learningPath->update($validated);

        return response()->json(['success' => 'Learning path updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $learningPath = LearningPath::findOrFail($id);
        $learningPath->delete();

        return response()->json(['success' => 'Learning Path deleted successfully!']);
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['error' => 'No FAQs selected for deletion.'], 400);
        }

        try {
            LearningPath::whereIn('id', $ids)->delete();
            return response()->json(['success' => 'Selected Learning Paths deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete Learning Paths.'], 500);
        }
    }
}