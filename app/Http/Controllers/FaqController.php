<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Faq::select('id', 'question', 'answer');

                return DataTables::of($data)
                    ->addColumn('actions', function ($row) {
                        return '
                            <a href="javascript:void(0);" class="edit-btn gray-s" data-id="' . $row->id . '" 
                                data-question="' . htmlspecialchars($row->question, ENT_QUOTES) . '" 
                                data-answer="' . htmlspecialchars($row->answer, ENT_QUOTES) . '">
                                <i class="uil uil-edit-alt ucp-table" title="Edit"></i>
                            </a>
                            <form action="' . route('faq.destroy', $row->id) . '" method="POST" class="delete-form d-inline-block">
                        ' . csrf_field() . method_field('DELETE') . '
                        
                            <a href="javascript:;" class="delete-btn gray-s" data-id="' . $row->id . '" title="Delete">
                                <i class="uil uil-trash-alt ucp-table"></i>
                            </a>
                        </form>';
                    })
                    ->rawColumns(['actions'])
                    ->make(true);
            }

            $faqs = Faq::paginate(3);
            Log::info('Fetched FAQs successfully', ['count' => $faqs->count()]);
            return view('admin.faq.list_faq', compact('faqs'));
        } catch (\Exception $e) {
            Log::error('Error fetching FAQs', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to load FAQs.');
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'question' => 'required|string|max:255',
                'answer' => 'required|string',
            ]);

            $faq = Faq::create([
                'question' => $request->input('question'),
                'answer' => $request->input('answer'),
            ]);

            Log::info('FAQ created successfully', ['faq_id' => $faq->id]);
            return response()->json(['success' => 'FAQ added successfully!']);
        } catch (\Exception $e) {
            Log::error('Error creating FAQ', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Failed to add FAQ.'], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'question' => 'required|string|max:255',
                'answer' => 'required|string',
            ]);

            $faq = Faq::findOrFail($id);
            $faq->update([
                'question' => $request->question,
                'answer' => $request->answer,
            ]);

            Log::info('FAQ updated successfully', ['faq_id' => $faq->id]);
            return response()->json(['success' => 'FAQ updated successfully!']);
        } catch (\Exception $e) {
            Log::error('Error updating FAQ', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Failed to update FAQ.'], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $faq = Faq::findOrFail($id);
            $faq->delete();

            Log::info('FAQ deleted successfully', ['faq_id' => $id]);
            return redirect()->back()->with('success', 'FAQ deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting FAQ', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->back()->with('error', 'Failed to delete FAQ.');
        }
    }

    public function bulkDelete(Request $request)
    {
        try {
            $ids = $request->ids;

            if (!is_array($ids) || empty($ids)) {
                return response()->json(['error' => 'No FAQs selected for deletion.'], 400);
            }

            Faq::whereIn('id', $ids)->delete();
            Log::info('Bulk deleted FAQs', ['faq_ids' => $ids]);
            return response()->json(['success' => 'Selected FAQs deleted successfully.']);
        } catch (\Exception $e) {
            Log::error('Error in bulk deleting FAQs', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'Failed to delete FAQs.'], 500);
        }
    }
}