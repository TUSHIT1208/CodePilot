<?php

namespace App\Http\Controllers;

use App\Models\adminprofile;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\LearnerProfile;
use App\Models\InstractorProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $learners = User::select([
                'id', 'username', 'profile_picture_url', 'first_name', 'middle_name', 
                'last_name', 'email', 'phone_number', 'date_of_birth', 'is_active'
            ])->where('role_id', operator: 3);

            return DataTables::of($learners)
                ->addColumn('profile', function ($learner) {
                    return !empty($learner->profile_picture_url) 
                        ? '<img id="profile_picture" src="' . asset($learner->profile_picture_url) . '" width="40">'
                        : '<h1 id="default_avtar">' . strtoupper(substr($learner->username, 0, 1)) . '</h1>';
                })
                ->addColumn('status', function ($learner) {
                    return '<div class="toggle-button mt-2 text-center">
                                <input type="checkbox" class="toggle-input" id="toggle' . $learner->id . '" data-user-id="' . $learner->id . '" ' . ($learner->is_active ? 'checked' : '') . '>
                                <label for="toggle' . $learner->id . '" class="toggle-label">
                                    <span class="toggle-circle"></span>
                                </label>
                            </div>';
                })
                ->addColumn('action', function ($learner) {
                    return '<a href="#" title="Edit" class="gray-s" data-bs-toggle="modal" data-bs-target="#editdetailsModal' . $learner->id . '">
                                <i class="uil uil-edit-alt ucp-table"></i>
                            </a>
                            <form action="' . route('user.destroy', $learner->id) . '" method="POST" class="delete-form d-inline-block">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <a href="javascript:;" title="Delete" class="gray-s delete-btn" data-username="' . $learner->username . '">
                                    <i class="uil uil-trash-alt ucp-table"></i>
                                </a>
                            </form>';
                })
                ->rawColumns(['profile', 'status', 'action']) // Ensures these columns render HTML
                ->make(true); // Return DataTable JSON response
        }

        $learners = User::where('role_id', 3)->get();
        return view('admin.learner.list', compact('learners'));
    }

    public function instructorList()
    {
        $instructor = User::where('role_id', 2)->paginate(10);
        return view('admin.instructor.list', compact('instructor'));
    }

    public function create()
    {
        //
    }

    public function register()
    {
        return view('auth.register');

    }

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

        if ($request->hasFile('profile_picture_url')) {
            $profileImage = $request->file('profile_picture_url');
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
    public function show(string $id)
    {
        $adminData = User::find($id);
        return view('admin.profile.my_admin_profile', compact('adminData'));
    }

    public function learner_show()
    {
        return view('learner.profile.my_learner_profile');
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        if ($id == 1) {
            $user = User::find($id);

            $request->validate([
                'first_name' => 'required|string',
                'username' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'dob' => 'required|date',
            ]);

            $user->update([
                'first_name' => $request->first_name,
                'username' => $request->username,
                'last_name' => $request->surname,
                'middle_name' => $request->middle_name,
                'email' => $request->email,
                'phone_number' => $request->phone,
                'date_of_birth' => $request->dob,
            ]);

            adminprofile::where('admin_id', $id)->update([
                'short_discription' => $request->description,
            ]);

            return redirect()->back();

        } else {
            $user = User::findOrFail($id);

            $validated = $request->validate([
                'username' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'middle_name' => 'nullable|string|max:255',
                'email' => 'required|email|max:255',
                'phone_number' => 'required|string|max:20',
                'date_of_birth' => 'required|date',
            ]);
            
            $user->username = $request->input('username');
            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->middle_name = $request->input('middle_name');
            $user->email = $request->input('email');
            $user->phone_number = $request->input('phone_number');
            $user->date_of_birth = $request->input('date_of_birth');
            
            $user->save();

            return redirect()->back()->with('success', 'Tutor updated successfully!');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'Tutor deleted successfully!');
    }

    public function updateUserStatus(Request $request)
    {
        $user = User::find($request->user_id);

        if ($user) {
            $user->is_active = $request->is_active;
            $user->save();
        }
        return response()->json(['success' => false], 400);
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validate the image
        ]);

        // Retrieve the currently authenticated user
        $user = Auth::user();

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName(); // Generate a unique file name
            $destinationPath = public_path('profile_images'); // Define the destination path in the public directory

            // Move the uploaded file to the public directory
            $file->move($destinationPath, $filename);

            // Update the user's profile image URL in the database
            $user->profile_picture_url = 'profile_images/' . $filename;
            $user->save();

            return redirect()->back();
        }

        return response()->json(['message' => 'No file uploaded'], 400);
    }

    public function aboutabmin(){
        $adminAbout = adminprofile::with('user')->where('admin_id',Auth::user()->id)->first();
        return view('admin.profile.setting',compact('adminAbout'));
    }

    public function learner_setting(){
        return view('learner.profile.setting');
    }

    public function bulkDelete(Request $request)
    {
        try {
            $ids = $request->ids;

        if (!empty($ids)) {
                User::whereIn('id', $ids)->delete();
                return response()->json(['success' => 'Selected users have been deleted successfully.']);
            } else {
                return response()->json(['error' => 'No users selected.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong. Please try again.'], 500);
        }
    }
}