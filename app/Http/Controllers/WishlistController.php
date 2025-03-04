<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItem = Cart::with(['course.courseattachment', 'course.category'])
            ->where('user_id', auth()->id())
            ->where('is_wishlist', 1)
            ->with('course')
            ->get();
            
            // return $wishlistItem;
            
        return view('learner.saved_course.saved_courses',compact('wishlistItem'));
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
        $user = auth()->user(); // Get the authenticated user

        // Check if course is already in the wishlist
        $existingWishlist = Cart::where('user_id', $user->id)
            ->where('course_id', $request->course_id)
            ->where('is_wishlist', 1)
            ->first();

        if ($existingWishlist) {
            return response()->json([
                'message' => 'Course is already in your Wishlist!'
            ], 409); // 409 Conflict
        }

        // Add to wishlist if not exists
        Cart::create([
            'user_id' => $user->id,
            'course_id' => $request->course_id,
            'is_wishlist' => 1,
            'created_by' => $user->id,
        ]);

        return response()->json([
            'message' => 'Course added to Wishlist successfully!'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        $wishlistItem = Cart::where('id', $id)->first();
        $wishlistItem->delete();
        return redirect()->back()->with('success', 'Course removed from Wishlist successfully!');
    }
}
