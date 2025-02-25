<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Sub_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $subCategories = Sub_Category::with('category');

                if ($request->category_id) {
                    $subCategories->where('category_id', $request->category_id);
                }

                return DataTables::of($subCategories)
                    ->addColumn('category_name', function ($subcategory) {
                        return $subcategory->category ? $subcategory->category->name : 'N/A';
                    })
                    ->addColumn('action', function ($subcategory) {
                        return '
                            <a href="javascript:void(0);" class="edit-category gray-s" 
                                data-id="' . $subcategory->id . '" 
                                data-name="' . $subcategory->name . '" 
                                data-description="' . $subcategory->description . '"
                                data-bs-toggle="modal" data-bs-target="#editSubcategoryModal">
                                <i class="uil uil-edit-alt ucp-table"></i>
                            </a>
                            <form action="' . route('subcategory.destroy', $subcategory->id) . '" method="POST" class="delete-form d-inline-block">
                                ' . csrf_field() . method_field('DELETE') . '
                                <a type="button" class="gray-s delete-btn" data-name="' . $subcategory->name . '">
                                    <i class="uil uil-trash-alt ucp-table"></i>
                                </a>
                            </form>';
                    })
                    ->editColumn('status', function ($subcategory) {
                        return '
                            <div class="toggle-button mt-2 text-center">
                                <input type="checkbox" class="toggle-input toggle-status"
                                    id="toggle' . $subcategory->id . '" 
                                    data-id="' . $subcategory->id . '" 
                                    ' . ($subcategory->is_active ? 'checked' : '') . '>
                                <label for="toggle' . $subcategory->id . '" class="toggle-label">
                                    <span class="toggle-circle"></span>
                                </label>
                            </div>';
                    })
                    ->rawColumns(['category_name', 'status', 'action'])
                    ->make(true);
            }

            $categories = Category::paginate(3);
            $subcategories = Sub_Category::with('category')->get();

            return view('admin.sub-category.sub_category', compact('categories', 'subcategories'));
        } catch (Exception $e) {
            Log::error('Error fetching subcategories: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching the subcategories. Please try again later.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'subcategory_name' => 'required|string|max:255',
                'subcategory_description' => 'nullable|string',
            ]);

            Sub_Category::create([
                'category_id' => $request->category_id,
                'name' => $request->subcategory_name,
                'description' => $request->subcategory_description,
            ]);

            return response()->json(['success' => 'SubCategory added successfully!']);
        } catch (Exception $e) {
            Log::error('Error adding subcategory: ' . $e->getMessage());
            // return response()->json(['error' => 'An error occurred while adding the subcategory. Please try again later.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'subcategory_name_edit' => 'required|string|max:255',
                'subcategory_description_edit' => 'nullable|string',
            ]);

            $subcategory = Sub_Category::findOrFail($id);
            $subcategory->update([
                'name' => $validatedData['subcategory_name_edit'],
                'description' => $validatedData['subcategory_description_edit'],
            ]);

            return response()->json(['success' => 'Subcategory updated successfully.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Subcategory not found.'], 404);
        } catch (Exception $e) {
            Log::error('Error updating subcategory: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while updating the subcategory. Please try again later.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Sub_Category::findOrFail($id);
            $category->delete();
            return redirect()->back()->with('success', 'SubCategory deleted successfully!');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'SubCategory not found.');
        } catch (Exception $e) {
            Log::error('Error deleting subcategory: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while deleting the subcategory. Please try again later.');
        }
    }

    public function updateSubCategoryStatus(Request $request)
    {
        try {
            $subCategory = Sub_Category::findOrFail($request->sub_category_id);
            $subCategory->is_active = $request->is_active;
            $subCategory->save();

            return response()->json(['success' => 'Subcategory status updated successfully.']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Subcategory not found.'], 404);
        } catch (Exception $e) {
            Log::error('Error updating subcategory status: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update subcategory status.'], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        try {
            $ids = $request->input('ids', []);

            if (!empty($ids)) {
                Sub_Category::whereIn('id', $ids)->delete();
                return response()->json(['success' => 'Sub-categories deleted successfully.']);
            }

            return response()->json(['error' => 'No sub-categories selected for deletion.'], 400);
        } catch (Exception $e) {
            Log::error('Error deleting subcategories: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while deleting subcategories. Please try again later.'], 500);
        }
    }
}
