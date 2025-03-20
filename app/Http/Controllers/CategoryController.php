<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $categories = Category::select(['id', 'name', 'description', 'is_active']);
                return DataTables::of($categories)
                    ->addColumn('action', function ($category) {
                        return '
                        <a href="javascript:void(0);" class="edit-category gray-s" 
                        data-id="' . $category->id . '" 
                        data-name="' . $category->name . '" 
                        data-description="' . $category->description . '">
                            <i class="uil uil-edit-alt ucp-table"></i>
                        </a>
                        <form action="' . route('category.destroy', $category->id) . '" method="POST" class="delete-form d-inline-block">
                            ' . csrf_field() . method_field('DELETE') . '
                            <a href="javascript:void(0);" title="Delete" class="gray-s delete-btn" data-username="' . $category->name . '">
                                <i class="uil uil-trash-alt ucp-table"></i>
                            </a>
                        </form>';
                    })
                    ->editColumn('status', function ($category) {
                        return '
                            <div class="toggle-button mt-2 text-left">
                            <input type="checkbox" class="toggle-input" 
                                id="toggle' . $category->id . '" 
                                data-id="' . $category->id . '" 
                                ' . ($category->is_active ? 'checked' : '') . '>
                            <label for="toggle' . $category->id . '" class="toggle-label">
                                <span class="toggle-circle"></span>
                            </label>
                        </div>';
                    })
                    ->rawColumns(['action', 'status'])
                    ->make(true);
            }

            $categories = Category::all();
            return view('admin.category.category', compact('categories'));
        } catch (Exception $e) {
            Log::error('Error fetching categories: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching categories.'], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_description' => 'nullable|string',
        ]);

        try {
            $category = Category::create([
                'name' => $request->input('category_name'),
                'description' => $request->input('category_description'),
                'is_active' => true,
            ]);

            Log::info('Category added: ', ['id' => $category->id, 'name' => $category->name]);
            return response()->json(['success' => 'Category added successfully!']);
        } catch (Exception $e) {
            Log::error('Error while adding category: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while adding the category.'], 500);
        }
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_description' => 'nullable|string'
        ]);

        try {
            $category->update([
                'name' => $request->category_name,
                'description' => $request->category_description
            ]);
            Log::info('Category updated: ', ['id' => $category->id, 'name' => $category->name]);
            return response()->json(['success' => 'Category updated successfully!']);
        } catch (Exception $e) {
            Log::error('Error updating category: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the category.'], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json(['error' => 'Category not found.'], 404);
            }

            if ($category->sub_categories()->where('is_active', 1)->exists()) {
                return response()->json(['error' => 'This category has active Sub-category. Please delete or deactivate them first before deleting the category.'], 400);
            }

            // Check if the category has any associated active courses
            if ($category->courses()->where('is_active', 1)->exists()) {
                return response()->json(['error' => 'This category has active courses. Please delete or deactivate them first before deleting the category.'], 400);
            }

            // If only inactive courses exist, allow deletion
            $category->delete();
            Log::info('Category deleted: ', ['id' => $id]);

            return response()->json(['success' => 'Category deleted successfully!'], 200);
        } catch (Exception $e) {
            Log::error('Error deleting category: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting the category.'], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $category = Category::find($request->category_id);
            if (!$category) {
                return response()->json(['error' => 'Category not found.'], 404);
            }
            $category->is_active = $request->is_active;
            $category->save();
            Log::info('Category status updated: ', ['id' => $category->id, 'status' => $category->is_active]);
            return response()->json(['success' => 'Category status updated successfully!']);
        } catch (Exception $e) {
            Log::error('Error updating category status: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the category status.'], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        try {
            $ids = $request->input('ids', []);
            if (!empty($ids)) {
                Category::whereIn('id', $ids)->delete();
                Log::info('Bulk delete executed: ', ['ids' => $ids]);
                return response()->json(['success' => 'Categories deleted successfully.']);
            }
            return response()->json(['error' => 'No categories selected.']);
        } catch (Exception $e) {
            Log::error('Error bulk deleting categories: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting categories.'], 500);
        }
    }

    public function category_list()
    {
        $categories = Category::with('sub_categories.courses')->get();

        return view('learner.layout.sidebar', compact('categories'));
    }
}
