<?php

namespace App\Http\Controllers;

use App\Models\certificate;
use App\Models\test;
use App\Models\PaymentTransaction;
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
        $certificate = certificate::all();
        return view("learner.course.certificate.genrate");
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
        $request->validate([
            'fullname' => 'required|string|max:64',
            'emailaddress' => 'required|email|max:64',
            'phonenumber' => 'required|string|max:10',
        ]);

        Certificate::create([

            'user_id' => Auth::user()->id,
            'test_id' => 1,
            'name' => $request->fullname,
            'email' => $request->emailaddress,
            'phone_no' => $request->phonenumber,
        ]);

        $course = session('course');

        $test = test::with(['testquestion.testoption'])->where('course_id', $course)->first();

        if (!$test) {
            return redirect()->back()->with('error', 'No test found for this course');
        }

        if (!session()->has('test_start_time')) {
            session(['test_start_time' => now()]);
        }

        return view('learner.course.certificate.test', compact('test'));
    }
    public function cirty()
    {
        // Get the certificates for the authenticated user
        $certificate = Certificate::where('user_id', Auth::user()->id)->first();
        //$test=test::where()
        //return $certificate;
        // Load the view and pass the certificate data
        $pdf = PDF::loadView('learner.course.certificate.certificate', compact('certificate'));

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