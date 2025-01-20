<?php

namespace App\Http\Controllers\Category;

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
            $categories = Category::all();
            $subcategories = Sub_Category::with('category')->get();

            return view('admin.sub_category', compact('categories', 'subcategories'));

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
    public function update(Request $request, sub_category $sub_category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sub_category $sub_category)
    {
        //
    }
}
