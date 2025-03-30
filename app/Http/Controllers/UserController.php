<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\course;
use App\Mail\WelcomeEmail;
use App\Models\user_course;
use App\Models\adminprofile;
use Illuminate\Http\Request;
use App\Models\LearnerProfile;
use App\Models\InstractorProfile;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Log;
use App\Mail\AdminNotificationEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $learners = User::select([
                'id',
                'username',
                'profile_picture_url',
                'first_name',
                'middle_name',
                'last_name',
                'email',
                'phone_number',
                'date_of_birth',
                'is_active'
            ])->where('role_id', operator: 3);

            return DataTables::of($learners)
                ->addColumn('profile', function ($learner) {
                    return !empty($learner->profile_picture_url)
                        ? '<img id="profile_picture" src="' . asset($learner->profile_picture_url) . '" width="40">'
                        : '<h1 class="default_avtar">' . strtoupper(substr($learner->first_name, 0, 1)) . '</h1>';
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
                    return '
                    <a href="javascript:void(0);" class="edit-learner gray-s" 
                        data-id="' . $learner->id . '" 
                        data-username="' . $learner->username . '" 
                        data-firstname="' . $learner->first_name . '" 
                        data-middlename="' . $learner->middle_name . '" 
                        data-lastname="' . $learner->last_name . '" 
                        data-email="' . $learner->email . '" 
                        data-phone="' . $learner->phone_number . '" 
                        data-dob="' . $learner->date_of_birth . '" 
                        data-bs-toggle="modal" data-bs-target="#editUserModal">
                        <i class="uil uil-edit-alt ucp-table"></i>
                    </a>
                    <form action="' . route('user.destroy', $learner->id) . '" method="POST" class="delete-form d-inline-block">
                        ' . csrf_field() . method_field('DELETE') . '
                        <a href="javascript:void(0);" title="Delete" class="gray-s delete-btn" data-username="' . $learner->username . '">
                            <i class="uil uil-trash-alt ucp-table"></i>
                        </a>
                    </form>';
                })
                ->addColumn('full_name', function ($user) {
                    return trim($user->first_name . ' ' . ($user->middle_name ?? '') . ' ' . $user->last_name);
                })
                ->filterColumn('full_name', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(first_name, ' ', COALESCE(middle_name, ''), ' ', last_name) LIKE ?", ["%{$keyword}%"]);
                })
                ->orderColumn('full_name', function ($query, $order) {
                    $query->orderByRaw("CONCAT(first_name, ' ', COALESCE(middle_name, ''), ' ', last_name) {$order}");
                })
                ->rawColumns(['profile', 'status', 'action', 'full_name'])
                ->make(true); // Return DataTable JSON response
        }

        $learners = User::where('role_id', 3)->get();
        return view('admin.learner.list', compact('learners'));
    }

    public function instructorList(Request $request)
    {
        if ($request->ajax()) {
            $instructors = User::select([
                'id',
                'username',
                'profile_picture_url',
                'first_name',
                'middle_name',
                'last_name',
                'email',
                'phone_number',
                'date_of_birth',
                'is_active'
            ])->where('role_id', 2);

            return DataTables::of($instructors)
                ->addColumn('profile', function ($instructors) {
                    return !empty($instructors->profile_picture_url)
                        ? '<img id="profile_picture" src="' . asset($instructors->profile_picture_url) . '" width="40">'
                        : '<h1 class="default_avtar">' . strtoupper(substr($instructors->first_name, 0, 1)) . '</h1>';
                })
                ->addColumn('status', function ($instructor) {
                    return '<div class="toggle-button mt-2 text-left">
                                <input type="checkbox" class="toggle-input" id="toggle' . $instructor->id . '" data-user-id="' . $instructor->id . '" ' . ($instructor->is_active ? 'checked' : '') . '>
                                <label for="toggle' . $instructor->id . '" class="toggle-label">
                                    <span class="toggle-circle"></span>
                                </label>
                            </div>';
                })
                ->addColumn('action', function ($instructor) {
                    return '
                    <a href="javascript:void(0);" class="edit-instructor gray-s" 
                        data-id="' . $instructor->id . '" 
                        data-username="' . $instructor->username . '" 
                        data-firstname="' . $instructor->first_name . '" 
                        data-middlename="' . $instructor->middle_name . '" 
                        data-lastname="' . $instructor->last_name . '" 
                        data-email="' . $instructor->email . '" 
                        data-phone="' . $instructor->phone_number . '" 
                        data-dob="' . $instructor->date_of_birth . '" 
                        data-bs-toggle="modal" data-bs-target="#editUserModal">
                        <i class="uil uil-edit-alt ucp-table"></i>
                    </a>
                    <form action="' . route('user.destroy', $instructor->id) . '" method="POST" class="delete-form d-inline-block">
                        ' . csrf_field() . method_field('DELETE') . '
                        <a href="javascript:void(0);" title="Delete" class="gray-s delete-btn" data-username="' . $instructor->username . '">
                            <i class="uil uil-trash-alt ucp-table"></i>
                        </a>
                    </form>';
                })
                ->addColumn('full_name', function ($instructor) {
                    return trim($instructor->first_name . ' ' . ($instructor->middle_name ?? '') . ' ' . $instructor->last_name);
                })
                ->filterColumn('full_name', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(first_name, ' ', COALESCE(middle_name, ''), ' ', last_name) LIKE ?", ["%{$keyword}%"]);
                })
                ->orderColumn('full_name', function ($query, $order) {
                    $query->orderByRaw("CONCAT(first_name, ' ', COALESCE(middle_name, ''), ' ', last_name) {$order}");
                })
                ->rawColumns(['profile', 'status', 'action', 'full_name'])
                ->make(true);
        }

        $instructors = User::where('role_id', 2)->paginate(10);
        return view('admin.instructor.list', compact('instructors'));
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
            // Username: Alphanumeric with underscores, 3-20 characters
            'username' => 'required|string|regex:/^[a-zA-Z0-9_]{3,20}$/|unique:users,username',

            // First Name: Only letters, minimum 2 characters
            'firstname' => 'required|string|regex:/^[A-Za-z]{2,}$/',

            // Middle Name: Optional, only letters if provided
            'middlename' => 'nullable|string|regex:/^[A-Za-z]*$/',

            // Last Name: Only letters, minimum 2 characters
            'lastname' => 'nullable|string|regex:/^[A-Za-z]{2,}$/',

            // Email Address: Valid email format and unique
            'emailaddress' => 'required|email|unique:users,email',

            // Password: Required, minimum 6 characters, confirmed
            'password' => 'required|string|min:6|confirmed',

            // Phone Number: Exactly 10 digits
            'phone_no' => 'required|regex:/^\d{10}$/', // 10-digit phone number

            // Date of Birth: Valid date
            'date_of_birth' => 'required|date',

            // Bio: Optional text
            'bio' => 'nullable|string',

            // Skill: Optional text
            'skill' => 'nullable|string',

            // Short Description: Optional, but no more than 255 characters
            'short_description' => 'nullable|string|max:255',
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
        Mail::to($user->email)->send(new WelcomeEmail($user));
        // ✅ Send Notification to Admin
        $admin = User::where('role_id', 1)->first(); // Assuming role_id = 1 is Admin
        if ($admin) {
            Mail::to($admin->email)->send(new AdminNotificationEmail($user));
        }
        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    public function store_learner(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            // Username: Alphanumeric with underscores, 3-20 characters
            'learner_username' => 'required|string|regex:/^[a-zA-Z0-9_]{3,20}$/|unique:users,username',

            // First Name: Only letters, minimum 2 characters
            'learner_firstname' => 'required|string|regex:/^[A-Za-z]{2,}$/',

            // Middle Name: Optional, only letters if provided
            'learner_middlename' => 'nullable|string|regex:/^[A-Za-z]*$/',

            // Last Name: Optional, but letters only if provided, minimum 2 characters
            'learner_lastname' => 'nullable|string|regex:/^[A-Za-z]{2,}$/',

            // Email Address: Valid email format and unique
            'learner_emailaddress' => 'required|email|unique:users,email',

            // Password: Required, minimum 6 characters, confirmed
            'password' => 'required|string|min:6|confirmed',

            // Phone Number: Exactly 10 digits
            'learner_phone_no' => 'required|regex:/^\d{10}$/', // 10-digit phone number

            // Date of Birth: Valid date
            'learner_date_of_birth' => 'required|date',
            
        ]);


        // Handle profile picture upload (if exists)
        if ($request->hasFile('profile_picture_url')) {
            $profileImage = $request->file('profile_picture_url');
            $profileImageName = time() . '.' . $profileImage->getClientOriginalExtension();
            $profileImage->move(public_path('/images/'), $profileImageName);
        } else {
            $profileImageName = null;
        }

        // Create the user record
        $user = User::create([
            'username' => $request->learner_username,
            'first_name' => $request->learner_firstname,
            'middle_name' => $request->learner_middlename,
            'last_name' => $request->learner_lastname,
            'email' => $request->learner_emailaddress,
            'password' => Hash::make($request->password),
            'phone_number' => $request->learner_phone_no,
            'date_of_birth' => $request->learner_date_of_birth,
            'address' => $request->address,
            'role_id' => 3,
            'is_active' => true,
        ]);

        // Create the learner profile
        LearnerProfile::create([
            'user_id' => $user->id,
        ]);
        Mail::to($user->email)->send(new WelcomeEmail($user));
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    public function show(string $id)
    {
        $adminData = User::with('adminprofile')->find($id);
        $mycourse = Course::where('user_id', $id)->get();
        $totalCourses = $mycourse->count();
        $totalLearners = User::where('role_id', '3')->count();
        return view('admin.profile.my_admin_profile', compact('adminData','mycourse','totalCourses','totalLearners'));
    }

    public function learner_show(string $id)
    {
        $leanerData = User::with('learnerprofile')->find($id);
        $mycourse=user_course::with('course')->where('user_id',$id)->get();
        $paymentTransactions = PaymentTransaction::whereHas('order.order_items.course')
                ->where('created_by', auth()->id())
                ->with('order.order_items.course')
                ->get();
        return view('learner.profile.my_learner_profile', compact('leanerData','mycourse','paymentTransactions'));
    }
    
    public function instructor_show(string $id)
    {
        $instructorData = User::with('instructorprofile')->find($id);
        $mycourse = Course::where('user_id', $id)->get();
        $totalCourses = $mycourse->count();
        $totalLearners = User::where('role_id', '3')->count();
        return view('instructor.profile.my_instructor_profile', compact('instructorData','mycourse','totalCourses','totalLearners'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $user = User::with('role')->find($id);
        $roleId = $user->role_id;   // Get role_id from users table
        $roleName = $user->role->name; // Get role name from roles table
        // return $roleName;

        if( $roleName == "learner"){
            $user->update([
                'first_name' => $request->first_name,
                'username' => $request->username,
                'last_name' => $request->surname,
                'middle_name' => $request->middle_name,
                'email' => $request->email,
                'phone_number' => $request->phone,
                'date_of_birth' => $request->dob,
            ]);
            log::info('learner updated');
            LearnerProfile::where('user_id', $id)->update([
                'short_description' => $request->description,
            ]);
            log::info('learner profile updated');
            return redirect()->back()->with('success', 'Profile updated successfully!');   
        }elseif($roleName == "admin"){
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

            return redirect()->back()->with('success', 'Profile updated successfully!');
        }elseif($roleName == "insructor"){
            $user->update([
                'first_name' => $request->first_name,
                'username' => $request->username,
                'last_name' => $request->surname,
                'middle_name' => $request->middle_name,
                'email' => $request->email,
                'phone_number' => $request->phone,
                'date_of_birth' => $request->dob,
            ]);

            InstractorProfile::where('user_id', $id)->update([
                'short_description' => $request->description,
            ]);

            return redirect()->back()->with('success', 'Profile updated successfully!');
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
        $user = User::findOrFail($request->user_id);

        $user->is_active = $request->is_active;
        $user->save();

        return response()->json(['success' => true, 'message' => 'User status updated successfully']);
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

    public function aboutabmin()
    {
        $adminAbout = adminprofile::with('user')->where('admin_id', Auth::user()->id)->first();
        return view('admin.profile.setting', compact('adminAbout'));
    }

    public function learner_setting()
    {
        $learnerData = LearnerProfile::with('user')->where('user_id', Auth::user()->id)->first();
        //return $learnerData;
        return view('learner.profile.setting',compact('learnerData'));
    }

    public function instructor_setting()
    {
        $instructorData = InstractorProfile::with('user')->where('user_id', Auth::user()->id)->first();
        //return $learnerData;
        return view('instructor.profile.setting',compact('instructorData'));
    }

    public function bulkDelete(Request $request)
    {
        try {
            // Validate that 'ids' is an array
            $request->validate([
                'ids' => 'required|array',
                'ids.*' => 'exists:users,id', // Ensure each ID exists in the users table
            ]);

            // Delete users where ID is in the array
            User::whereIn('id', $request->ids)->delete();

            return response()->json(['success' => 'Selected instructors deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting instructors.'], 500);
        }
    }

    public function mycourse(Request $request)
    {
        $id = Auth::user()->id;
        $mycourse = user_course::with('course')->where('user_id', $id)->get();
        $paymentTransactions = PaymentTransaction::whereHas('order.order_items.course')
            ->where('created_by', auth()->id())
            ->with('order.order_items.course')
            ->get();
        return view('learner.purches_cource.list', compact('mycourse', 'paymentTransactions'));
    }



}