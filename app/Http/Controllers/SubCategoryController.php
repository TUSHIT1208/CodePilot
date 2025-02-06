<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\sub_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Category::paginate(3);
            $subcategories = Sub_Category::with('category')->get();

            return view('admin.sub-category.sub_category', compact('categories', 'subcategories'));

        } catch (\Exception $e) {
            Log::error('Error fetching subcategories: ' . $e->getMessage());
            return redirect()->route('category.index')->with('error', 'An error occurred while fetching the categories. Please try again later.');
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
        } catch (\Exception $e) {
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
        $category = Sub_Category::find($request->category_id);

        if ($category) {
            // Update the category's is_active status
            $category->is_active = $request->is_active;
            $category->save();

            // Return a success response
            return response()->json([
                'success' => $category->is_active ? 'SubCategory has been activated successfully!' : 'SubCategory has been deactivated successfully!',
            ]);

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