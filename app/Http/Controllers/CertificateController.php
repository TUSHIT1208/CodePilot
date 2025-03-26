<?php

namespace App\Http\Controllers;

use App\Models\test;
use App\Models\certificate;
use App\Models\test_result;
use Illuminate\Http\Request;
use App\Mail\CourseCertificate;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PaymentTransaction;
use App\Models\test_result_answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificate = certificate::all()->last();
        $test_result = test_result::all()->last();
        $course = session('course');
        $test_id = test::where('course_id', $course)->first();
        $p_marks = $test_id->passing_mark;
        return view(
            "learner.course.certificate.genrate",
            compact('certificate', 'test_result', 'p_marks')
        );
    }
    public function list(Request $request)
    {
        $userId = Auth::user()->id;

        // $certificates = Certificate::where('user_id', $userId)
        //     ->with('test') // Eager load the related test data
        //     ->select('certificates.id as certificate_id', 'certificates.test_id', 'certificates.created_at'); // Specify table names
        // return $certificates;
        if ($request->ajax()) {
            $certificates = Certificate::where('user_id', $userId)
                ->with('test') // Eager load the related test data
                ->select('certificates.id as certificate_id', 'certificates.test_id', 'certificates.created_at'); // Specify table names

            return DataTables::of($certificates)
                ->addColumn('test_title', function ($certificate) {
                    return $certificate->test->test_title ?? 'N/A';
                })
                ->addColumn('passing_mark', function ($certificate) {
                    return $certificate->test->passing_mark ?? 'N/A';
                })
                ->addColumn('total_marks', function ($certificate) {
                    return $certificate->test->total_marks ?? 'N/A';
                })
                ->addColumn('created_at', function ($certificate) {
                    return $certificate->created_at->format('Y-m-d'); // Format as YYYY-MM-DD
                })
                ->addColumn('certificate', function ($certificate) {
                    return '<form action="' . route('certificate.download', $certificate->certificate_id) . '" method="get">
                            <button type="submit" class="btn"><i class="fa fa-download"></i></button>
                        </form>';
                })
                ->rawColumns(['certificate']) // Allow HTML rendering
                ->make(true);
        }

        return view('learner.certificate.list');
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
    // public function store(Request $request)
    // {
    //     $course = session('course');
    //     $test_id = test::where('course_id', $course)->first();

    //     //     $request->validate([
    //     //         'fullname' => 'required|string|max:64',
    //     //         'emailaddress' => 'required|email|max:64',
    //     //         'phonenumber' => 'required|string|max:10',
    //     //     ]);
    //     logger("create");
    //     $certificate = Certificate::create([

    //         'user_id' => Auth::user()->id,
    //         'test_id' => $test_id->id,
    //         'name' => $request->fullname,
    //         'email' => $request->emailaddress,
    //         'phone_no' => $request->phonenumber,
    //     ]);
    //     logger("create...");
    //     // return $course;
    // }

    public function gettest()
    {
        $course = session('course');
        $test = Test::with(['testquestion.testoption'])
            ->where('course_id', $course)
            ->first();

        // Get all testquestions ordered by position (assuming there's a 'position' column)
        $questions = $test->testquestion()->orderBy('position')->get();

        // Optionally, loop through the questions and get their options
        foreach ($questions as $question) {
            $questionOptions = $question->testoption;
            // You can work with each $question and its $questionOptions here
        }

        logger($test);

        if (!$test) {
            logger($course);
            logger('No test found for this course');
            return redirect()->back()->with('error', 'No test found for this course');
        }

        if (!session()->has('test_start_time')) {
            session(['test_start_time' => now()]);
        }

        return view('learner.course.certificate.test', compact('test'));
    }

    public function cirty()
    {
        logger('in cirty');
        $course = session('course');

        // Ensure test exists
        $test = Test::where('course_id', $course)->first();
        if (!$test) {
            return back()->with('error', 'Test not found for this course.');
        }

        $tid = $test->id;
        $tname = $test->test_title;

        // Ensure certificate exists
        $certificate = Certificate::where('user_id', Auth::id())
            ->where('test_id', $tid)
            ->first();

        if (!$certificate) {
            return back()->with('error', 'Certificate not found.');
        }

        $pdf = PDF::loadView('learner.course.certificate.certificate', compact('tname', 'certificate'));

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'certificate.pdf');
    }


    public function view($certificate_id, Request $request)
    {
        //     $course = session('course');
        //     $test_id = test::where('course_id', $course)->first();
        //     $tid = $test_id->id;
        //     $tname = $test_id->test_title;
        //     $certificate = Certificate::where('user_id', Auth::user()->id)
        //         ->where('test_id', $tid)->first();

        //     $pdf = PDF::loadView('learner.course.certificate.certificate', compact('tname', 'certificate'));

        // Get the certificate based on the provided certificate ID
        // $course = session('course');
        // $test_id = test::where('course_id', $course)->first();
        // $certificate = Certificate::create([
        //     'user_id' => Auth::user()->id,
        //     'test_id' => $test_id->id,
        //     'name' => Auth()->user()->first_name,
        //     'email' => Auth()->user()->email,
        //     'phone_no' => Auth()->user()->phone_number,
        // ]);

        $certificate = Certificate::findOrFail($certificate_id);

        // Get the related test information
        $test = $certificate->test;

        // Load the view and pass the necessary data
        $pdf = PDF::loadView('learner.course.certificate.certificate', [
            'tname' => $test->test_title,
            'certificate' => $certificate
        ]);
        // Return the PDF as a downloadable file
        return $pdf->download('certificate.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show(certificate $certificate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(certificate $certificate)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, certificate $certificate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }

    public function del()
    {
        //
    }
}