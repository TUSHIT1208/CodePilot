<?php

namespace App\Http\Controllers\Category;


use Exception;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Fetch all categories from the database
            $categories = Category::paginate(3);
    
            // Pass the categories to the view
            return view('admin.category.category', compact('categories'));
        } catch (Exception $e) {
            // Log the error message
            \Log::error('Error while fetching categories: ' . $e->getMessage());
    
            // Redirect with error message
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

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the category by ID or fail if it doesn't exist
        $category = Category::findOrFail($id);
        
        // Validate the input data
        $data = $request->validate([
            'category_name' => 'required|string|max:255',  // Validating category name
            'category_description' => 'required|string',   // Validating category description
        ]);

        // Update the category record with the validated data
        $category->update([
            'name' => $data['category_name'],
            'description' => $data['category_description'],
        ]);

        // Return response to inform user about the success of the operation
        return redirect()->back()->with('success', 'Category updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }
    public function updateCategoryStatus(Request $request)
    {
        try{
            $category = Category::find($request->category_id);

            if ($category) {
                // Update the category's is_active status
                $category->is_active = $request->is_active;
                $category->save();

                // Return a success response
                return response()->json([
                    'success' => $category->is_active ? 'Category has been activated successfully!' : 'Category has been deactivated successfully!',
                ]);
                
            }    
        } catch(Exception $e) {
            // Log the error message
            \Log::error('Error while updating category status: ' . $e->getMessage());

            // Return an error response
            return response()->json(['error' => 'An error occurred while updating the category status. Please try again later.']);
        }   
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids', []);

        if (!empty($ids)) {
            Category::whereIn('id', $ids)->delete();
            return response()->json(['success' => 'Categories deleted successfully.']);
        }

        return response()->json(['error' => 'No categories selected for deletion.'], 400);
    }
}
