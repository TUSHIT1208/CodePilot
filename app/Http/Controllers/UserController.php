<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\LearnerProfile;
use App\Models\InstractorProfile;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('');
        //  return redirect('/register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'firstname' => 'required|string',
            'middlename' => 'nullable|string',
            'lastname' => 'required|string',
            'emailaddress' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone_no' => 'required|string',
            'profile_picture_url' => 'nullable|required',
            'date_of_birth' => 'required|date',
            'bio' => 'nullable|string',
            'skill' => 'nullable|string',
            'short_description' => 'nullable|string|max:255', // Short description for instructors
        ]);
    
        // Handle profile picture upload (if exists)
        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image');
            $profileImageName = time() . '.' . $profileImage->getClientOriginalExtension();
            $profileImage->move(public_path('/images/'), $profileImageName);
        } else {
            $profileImageName = null;
        }
  
        
        // // Start transaction to ensure atomicity
        // \DB::beginTransaction();
    
        // try {
            // Create the user record
            $user = User::create([
                'username' => $request->username,
                'first_name' => $request->firstname,
                'middle_name' => $request->middlename,
                'last_name' => $request->lastname,
                'email' => $request->emailaddress,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phone_no,
                'profile_picture_url' => $profileImageName,
                'date_of_birth' => $request->date_of_birth,
                'role_id' => 2, // Assign the instructor role ID
                'is_active' => true, // Assuming the user is active by default
            ]);
    
            // Create the instructor profile
            InstractorProfile::create([
                'user_id' => $user->id,
                'bio' => $request->bio,
                'skills' => $request->skill, 
            ]);
            return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    
        //     // Commit the transaction
            
        //     \DB::commit();
        //     return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
        // } catch (\Exception $e) {
        //     // Rollback the transaction in case of error
        //     \DB::rollback();
    
        //     return back()->withErrors(['error' => 'Something went wrong. Please try again.']);
        // }
    }
    public function store_learner(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'username' => 'required|string',
            'firstname' => 'required|string',
            'middlename' => 'nullable|string',
            'lastname' => 'nullable|string',
            'emailaddress' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone_no' => 'required|string',
            'profile_picture_url' => 'nullable|required',
            'date_of_birth' => 'required|date',
            'profession_headline' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:255',
        ]);

        // Handle profile picture upload (if exists)
        if ($request->hasFile('profile_picture_url')) {
            $profileImage = $request->file('profile_picture_url');
            $profileImageName = time() . '.' . $profileImage->getClientOriginalExtension();
            $profileImage->move(public_path('/images/'), $profileImageName);
        } else {
            $profileImageName = null;
        }


        // Start transaction to ensure atomicity
        \DB::beginTransaction();

        try {
            // Create the user record
            $user = User::create([
                'username' => $request->username,
                'first_name' => $request->firstname,
                'middle_name' => $request->middlename,
                'last_name' => $request->lastname,
                'email' => $request->emailaddress,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phone_no,
                'profile_picture_url' => $profileImageName,
                'date_of_birth' => $request->date_of_birth,
                'role_id' => 3, // Assign the learner role ID
                'is_active' => true, // Assuming the user is active by default
            ]);

            // Create the learner profile
            LearnerProfile::create([
                'user_id' => $user->id,
            ]);

            // Commit the transaction
            \DB::commit();

            return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            \DB::rollback();

            return back()->withErrors(['error' => 'Something went wrong. Please try again.']);
        }
        }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
