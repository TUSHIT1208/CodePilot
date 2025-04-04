<?php

namespace App\Http\Controllers;

use session;
use App\Models\test;
use App\Models\certificate;
use App\Models\test_result;
use Illuminate\Http\Request;
use App\Mail\CourseCertificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\DataTables;
use App\Models\PaymentTransaction;
use App\Models\test_result_answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Contracts\DataTable;

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
        //     ->with([
        //         'test' => function ($query) {
        //             $query->select('id', 'course_id', 'test_title', 'passing_mark', 'total_marks', 'created_at');
        //         },
        //         'test.testresult' => function ($query): void {
        //             $query->select('id', 'test_id', 'overall_score'); // Ensure test_id is selected for proper relation
        //         },
        //         'test.course' => function ($query) {
        //             $query->select('id', 'title');
        //         }
        //     ])
        //     ->select('id as certificate_id', 'user_id', 'test_id', 'name', 'email', 'phone_no', 'created_at')
        //     ->get();



        // return $certificates;



        if ($request->ajax()) {
            $certificates = Certificate::where('user_id', $userId)
                ->with([
                    'test' => function ($query) {
                        $query->select('id', 'course_id', 'test_title', 'passing_mark', 'total_marks', 'created_at');
                    },
                    'test.testresult' => function ($query): void {
                        $query->select('id', 'test_id', 'overall_score'); // Ensure test_id is selected for proper relation
                    },
                    'test.course' => function ($query) {
                        $query->select('id', 'title');
                    }
                ])
                ->select('id as certificate_id', 'user_id', 'test_id', 'name', 'email', 'phone_no', 'created_at')
                ->get();

            return DataTables::of($certificates)
                ->addColumn('course_title', function ($certificate) {
                    return optional($certificate->test->course)->title ?? 'N/A';
                })
                ->addColumn('test_title', function ($certificate) {
                    return $certificate->test->test_title ?? 'N/A';
                })
                ->addColumn('overall_score', function ($certificate) {
                    return optional($certificate->test->testresult)->overall_score ?? 'N/A'; // Change 'testresult' to 'test_result'
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

        $certificates = Certificate::where('user_id', $userId)
            ->with('test')->get();
        return view('learner.certificate.list', compact('certificates'));
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
        $tname = $test->course->title;
        logger($tname);

        // Ensure certificate exists
        $certificate = Certificate::where('user_id', Auth::id())
            ->where('test_id', $tid)
            ->first();
        logger($certificate);
        $test_result = test_result::where('user_id', auth()->id())
        ->where('test_id', $tid)
        ->latest() //last record
        ->first();
        logger("total_marks".$test_result->test->total_marks);
        logger($test_result);
        if (!$certificate) {
            return back()->with('error', 'Certificate not found.');
        }

        $pdf = PDF::loadView('learner.course.certificate.certificate', compact('tname', 'certificate'));
        logger('pdf');
        try {
            Mail::to(Auth::user()->email)->send(new CourseCertificate($certificate, $test_result, $pdf));
            logger('Certificate email sent successfully');
        } catch (\Exception $e) {
            logger(' Error sending email: ' . $e->getMessage());
        }

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
            'tname' => $test->course->title,
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