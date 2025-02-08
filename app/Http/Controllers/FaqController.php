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
                    return '<a class="edit-btn gray-s" data-id="' . $row->id . '" 
                            data-question="' . htmlspecialchars($row->question, ENT_QUOTES) . '" 
                            data-answer="' . htmlspecialchars($row->answer, ENT_QUOTES) . '">
                            <i class="uil uil-edit-alt ucp-table"></i>
                        </a>
                        <form action="' . route('faq.destroy', $row->id) . '" method="POST" class="delete-form d-inline-block">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <a href="javascript:;" title="Delete" class="gray-s delete-btn" data-id="' . $row->id . '">
                                <i class="uil uil-trash-alt ucp-table"></i>
                            </a>
                        </form>';
                })
                ->rawColumns(['checkbox', 'actions'])
                ->make(true);
        }
        $faqs = faq::paginate(3);
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

        return redirect()->back()->with('success', 'FAQ added successfully!');
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

        return redirect()->route('faq.index')->with('success', 'FAQ updated successfully!');
    }

    public function destroy(string $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->back()->with('success', 'FAQ deleted successfully!');
    }

    public function bulkDelete(Request $request)
    {
        if (!$request->has('ids') || empty($request->ids)) {
            return response()->json(['error' => 'No FAQs selected.'], 400);
        }
    
        Faq::whereIn('id', $request->ids)->delete();
    
        return response()->json(['success' => 'Selected FAQs have been deleted successfully!']);
    }

}