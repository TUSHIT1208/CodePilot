<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Faq::select('id', 'question', 'answer');

            return DataTables::of($data)
                ->addColumn('actions', function ($row) {
                    return '<div class="action-icons">
                            <a href="javascript:;" class="edit-btn" data-id="' . $row->id . '" 
                                data-question="' . htmlspecialchars($row->question, ENT_QUOTES) . '" 
                                data-answer="' . htmlspecialchars($row->answer, ENT_QUOTES) . '">
                                <i class="uil uil-edit-alt ucp-table" title="Edit"></i>
                            </a>
                            <a href="javascript:;" class="delete-btn" data-id="' . $row->id . '" title="Delete">
                                <i class="uil uil-trash-alt ucp-table"></i>
                            </a>
                        </div>';
                })
                ->rawColumns(['actions']) // No 'checkbox' column found, so removed it
                ->make(true);
        }

        $faqs = Faq::paginate(3); // Ensure 'Faq' starts with uppercase (model name)
        return view('admin.faq.list_faq', compact('faqs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        Faq::create([
            'question' => $request->input('question'),
            'answer' => $request->input('answer'),
        ]);

        return response()->json(['success' => 'FAQ added successfully!']);
    }

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

        return response()->json(['success' => 'FAQ updated successfully!']);
        ;
    }

    public function destroy(string $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->back()->with('success', 'FAQ deleted successfully!');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids; // Get the array of IDs from the request

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['error' => 'No FAQs selected for deletion.'], 400);
        }

        try {
            Faq::whereIn('id', $ids)->delete();
            return response()->json(['success' => 'Selected FAQs deleted successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete FAQs.'], 500);
        }
    }
}