<?php

namespace App\Http\Controllers;

use App\Models\LearningPath;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;

class LearningPathController extends Controller
{
    public function index(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            Log::error('Error fetching learning paths', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);
            return redirect()->back()->with('error', 'Failed to load learning paths.');
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            $learningPath = LearningPath::create($validated);
            Log::info('Learning path created successfully', ['learning_path_id' => $learningPath->id]);

            return response()->json(['success' => 'Learning path added successfully.']);
        } catch (\Exception $e) {
            Log::error('Error adding learning path', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);
            return response()->json(['error' => 'An error occurred while adding the learning path.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            $learningPath = LearningPath::findOrFail($id);
            $learningPath->update($validated);
            Log::info('Learning path updated successfully', ['learning_path_id' => $id]);

            return response()->json(['success' => 'Learning path updated successfully.']);
        } catch (\Exception $e) {
            Log::error('Error updating learning path', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);
            return response()->json(['error' => 'An error occurred while updating the learning path.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $learningPath = LearningPath::findOrFail($id);
            $learningPath->delete();
            Log::info('Learning path deleted successfully', ['learning_path_id' => $id]);

            return response()->json(['success' => 'Learning Path deleted successfully!']);
        } catch (\Exception $e) {
            Log::error('Error deleting learning path', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);
            return response()->json(['error' => 'An error occurred while deleting the learning path.'], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids;

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['error' => 'No Learning Paths selected for deletion.'], 400);
        }

        try {
            LearningPath::whereIn('id', $ids)->delete();
            Log::info('Bulk delete successful', ['learning_path_ids' => $ids]);
            return response()->json(['success' => 'Selected Learning Paths deleted successfully.']);
        } catch (\Exception $e) {
            Log::error('Error in bulk deleting learning paths', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);
            return response()->json(['error' => 'Failed to delete Learning Paths.'], 500);
        }
    }
}
