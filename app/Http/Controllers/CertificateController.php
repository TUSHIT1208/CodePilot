<?php

namespace App\Http\Controllers;

use App\Models\certificate;
use App\Models\test;
use App\Models\PaymentTransaction;
use App\Models\test_result;
use App\Models\test_result_answer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $course = session('course');
        $test_id = test::where('course_id', $course)->first();

        //     $request->validate([
        //         'fullname' => 'required|string|max:64',
        //         'emailaddress' => 'required|email|max:64',
        //         'phonenumber' => 'required|string|max:10',
        //     ]);
        logger("create");
        Certificate::create([

            'user_id' => Auth::user()->id,
            'test_id' => $test_id->id,
            'name' => $request->fullname,
            'email' => $request->emailaddress,
            'phone_no' => $request->phonenumber,
        ]);
        logger("create...");
        // return $course;

        $test = test::with(['testquestion.testoption'])->where('course_id', $course)->first();
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
        $course = session('course');
        $test_id = test::where('course_id', $course)->first();
        $tid = $test_id->id;
        $tname = $test_id->test_title;
        // Get the certificates for the authenticated user
        $certificate = Certificate::where('user_id', Auth::user()->id)
            ->where('test_id', $tid)->first();
        //return $certificate;
        //$test=test::where()
        //return $certificate;
        // Load the view and pass the certificate data
        $pdf = PDF::loadView('learner.course.certificate.certificate', compact('tname', 'certificate'));

        // Return the PDF as a downloadable file
        return $pdf->download('certificate.pdf');
    }

    /**
     * Display the specified resource.
     */
    public function show(certificate $certificate)
    {
        // $certificate = certificate::where('user_id', Auth::user()->id)->get();
        // return $certificate;
        // $pdf = Pdf::loadView('learner.course.certificate.pdf', compact('certificate'));

        // // Return the PDF for download
        // return $pdf->download("invoice-{$certificate->id}.pdf");
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
    public function destroy(certificate $certificate)
    {
        //
    }
}