<?php

namespace App\Http\Controllers;

use App\Models\faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    public function index()
    {
        $faqs = FAQ::paginate(3); // Fetch all FAQs
        return view('admin.faq.list_faq', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255', // Corrected max length
            'answer' => 'required|string',
        ]);

        // Insert FAQ
        FAQ::create([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'FAQ added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(faq $faq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq = Faq::findOrFail($id);
        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        return redirect()->route('faq.index')->with('success', 'FAQ updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = FAQ::findOrFail($id); // Find the FAQ
        $faq->delete(); // Delete FAQ

        return redirect()->back()->with('success', 'FAQ deleted successfully!');
    }
}