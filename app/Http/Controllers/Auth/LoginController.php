<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\courseAttachment;
use App\Models\user_video_tracker;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\IncompleteCourseReminder;

class LoginController extends Controller
{
    //use AuthenticatesUsers;

    public function create()
    {
        return view('auth.login');
    }
    public function login_check(request $request)
    {
        logger("login_check");
        $userData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        try{
        if (Auth::attempt($userData)) {
            $user = Auth::user();
                logger($userData);
                log::info($user);
            if ($user->role && $user->role->name === 'admin') {
                return redirect()->route('dashboard.index');
            } elseif ($user->role && $user->role->name === 'insructor') {
                if (AUth::User()->is_active === 0) {
                    return back()->with('warning', 'You are temporarly Blocked');
                }
                return redirect()->route('instructor.dashboard');
            } elseif ($user->role && $user->role->name === 'learner') {
                if (AUth::User()->is_active === 0) {
                    return back()->with('warning', 'You are temporarly Blocked');
        }
                $oneMonthAgo = now()->subMonth();
                logger($oneMonthAgo);
                // Get distinct course IDs where the user has not watched the video for more than 1 month
                $incompleteCourses = user_video_tracker::where('user_id', $user->id)
                    ->where('updated_at', '<', $oneMonthAgo)
                    ->distinct('course_attachment_id') //distinct remove duplicate record
                    ->get();

                    $coursesList = [];

                    if ($incompleteCourses->count() > 0) {
                        foreach ($incompleteCourses as $tracker) {
                            $courseAttachment = CourseAttachment::find($tracker->course_attachment_id);

                            if ($courseAttachment) {
                                $courseTitle = $courseAttachment->course->title;
                                $courseId = $courseAttachment->course_id;

                                // Add to list of incomplete courses
                                $coursesList[] = [
                                    'course_id' => $courseId,
                                    'course_title' => $courseTitle
                                ];
                            }
                        }

                        if (!empty($coursesList)) {
                            try {
                                logger("Sending reminder email to learner: " . $user->email);

                                // Send email with all incomplete courses
                                Mail::to($user->email)->send(new IncompleteCourseReminder($coursesList));

                                logger("Reminder email sent for incomplete courses");
                            } catch (\Exception $e) {
                                logger('Error sending reminder email: ' . $e->getMessage());
                            }
                        }
                    }
    
                return redirect()->route('learner.dashboard');
            }

        } else {
            return back()->with('error', 'Invalid Email or Password');
        }
        }catch (\Exception $e) {
            Log::error('Error login : ' . $e->getMessage());
            // return response()->json(['error' => 'An error occurred while updating the category.'], 500);
        }
    }
    
    public function logout()
    {
        Auth::logout();
        
        return redirect()->route('login');
    }
    public function create_changepassword()
    {
        return view('change_password');
    }
    public function changePassword(Request $request)
    {
        // Validate the input
        $request->validate([
            'currentPassword' => ['required'],
            'newPassword' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->currentPassword, $user->password)) {
            return back()->withErrors(['currentPassword' => 'The current password is incorrect.']);
        }

        // Update the user's password using the update method
        $user->update([
            'password' => Hash::make($request->newPassword),
        ]);

        // Redirect with success message
        return back()->with('success', 'Password changed successfully!');
    }

    public function closeAccount(Request $request)
    {   
        log::info("closeAccount");
        $request->validate([
            'yourassword' => 'required',
        ]);
    
        $user = Auth::user();
        logger($user);
        // Check if the provided password is correct
        if (!Hash::check($request->yourassword, $user->password)) {
            return response()->json(['success' => false, 'message' => 'Incorrect password.'], 401);
        }
    
        Auth::logout(); // Log out the user
        $user->delete(); // Delete the user from the database
    
        return response()->json(['success' => true]);
    }

}