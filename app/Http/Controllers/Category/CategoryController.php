<?php

namespace App\Http\Controllers\Category;


use Exception;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::select(['id', 'name', 'description', 'is_active']);

            if ($categories->count() === 0) {
                return response()->json(['no_data' => true]);
            }

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
                        <div class="toggle-button mt-2 text-center">
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
            return view('admin.category.category',compact('categories'));
    }
    public function create()
    {
       //
    }

    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_description' => 'nullable|string',
        ]);

        try {
            // Create a new category using the create() method
            Category::create([
                'name' => $request->input('category_name'),
                'description' => $request->input('category_description'),
                'is_active' => true, // Set to active by default
            ]);

            // Return a JSON response if the category is successfully created
            return response()->json(['success' => 'Category added successfully!']);
        } catch (Exception $e) {
            // Log the error message
            \Log::error('Error while adding category: ' . $e->getMessage());

            // Return a JSON response with an error message
            return response()->json(['error' => 'An error occurred while adding the category. Please try again later.']);
        }
    }

    public function show(category $category)
    {
        //
    }

    public function edit(category $category)
    {
        //
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'category_description' => 'nullable|string'
        ]);

        $category->update([
            'name' => $request->category_name,
            'description' => $request->category_description
        ]);

        return response()->json(['success' => 'Category updated successfully!']);
    }

    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }

    public function updateStatus(Request $request)
    {
        $category = Category::find($request->category_id);
        if (!$category) {
            return response()->json(['error' => 'Category not found.'], 404);
        }
        $category->is_active = $request->is_active;
        $category->save();

        return response()->json(['success' => 'Category status updated successfully!']);
    }


    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            Category::whereIn('id', $ids)->delete();
            return response()->json(['success' => 'Categories deleted successfully.']);
        }
        return response()->json(['success' => 'Selected users have been deleted successfully.']);
    }
}
