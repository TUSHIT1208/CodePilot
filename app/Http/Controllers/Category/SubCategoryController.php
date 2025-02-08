<?php

namespace App\Http\Controllers\Category;

use App\Models\category;
use App\Models\sub_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $subCategories = Sub_Category::with('category');

                // Apply search filter
                if ($request->has('search') && $request->search['value'] != '') {
                    $search = $request->search['value'];
                    $subCategories->where(function ($query) use ($search) {
                        $query->whereHas('category', function ($q) use ($search) {
                            $q->where('name', 'LIKE', "%{$search}%");
                        })
                        ->orWhere('name', 'LIKE', "%{$search}%")
                        ->orWhere('description', 'LIKE', "%{$search}%");
                    });
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
                                data-description="' . $subcategory->description . '">
                                <i class="uil uil-edit-alt ucp-table"></i>
                            </a>
                            <form action="' . route('sub_category.destroy', $subcategory->id) . '" method="POST" class="delete-form d-inline-block">
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="gray-s delete-btn" data-name="' . $subcategory->name . '">
                                    <i class="uil uil-trash-alt ucp-table"></i>
                                </button>
                            </form>';
                    })
                    ->addColumn('is_active', function ($subcategory) {
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
                    ->rawColumns(['category_name', 'is_active', 'action'])
                    ->make(true);
            }

            $categories = Category::paginate(3);
            $subcategories = Sub_Category::with('category')->get();

            return view('admin.sub-category.sub_category', compact('categories', 'subcategories'));
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching the subcategories. Please try again later.'], 500);
        }
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
        
            $request->validate([
                'category_id' => 'required|exists:categories,id',
                'subcategory_name' => 'required|string|max:255',
                'subcategory_description' => 'nullable|string',
            ]);
        try {
            Sub_Category::create([
                'category_id' => $request->category_id,
                'name' => $request->subcategory_name,
                'description' => $request->subcategory_description,
            ]);

            return response()->json(['success' => 'SubCategory added successfully!']);
        } catch (Exception $e) {
            Log::error('Error adding subcategory: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while adding the subscategory. Please try again later.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(sub_category $sub_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(sub_category $sub_category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //dd('hello');
        
        // try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                // 'category_id' => 'required|exists:categories,id',  // Validate that category_id exists in categories table
                'subcategory_name_edit' => 'required|string|max:255',  // Validate subcategory name
                'subcategory_description_edit' => 'nullable|string',   // Validate subcategory description
            ]);

            // Find the subcategory by ID
            $subcategory = sub_category::findOrFail($id);
            // return $subcategory;    
            // Update the subcategory with validated data
            $subcategory->update([
                // 'category_id' => $validatedData['category_id'],   // Update the category ID
                'name' => $validatedData['subcategory_name_edit'],     // Update the subcategory name
                'description' => $validatedData['subcategory_description_edit'], // Update the subcategory description
            ]);
            

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Subcategory updated successfully!');
        // }  catch (\Exception $e) {
        //     // Handle any other exceptions
        //     return redirect()->back()->with('error', 'Failed to update subcategory: ' . $e->getMessage());
        // }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Sub_Category::find($id);
        $category->delete();
        return redirect()->back()->with('success', 'SubCategory deleted successfully!');
    }
    public function updateSubCategoryStatus(Request $request)
    {
        try {
            $subcategory = Sub_Category::findOrFail($request->sub_category_id);
            $subcategory->is_active = $request->is_active;
            $subcategory->save();

            return response()->json(['success' => 'Status updated successfully.']);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the status. Please try again later.'], 500);
        }
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);

        if (!empty($ids)) {
            sub_category::whereIn('id', $ids)->delete();
            return response()->json(['success' => 'Sub-categories deleted successfully.']);
        }

        return response()->json(['error' => 'No sub-categories selected for deletion.'], 400);
    }
}
